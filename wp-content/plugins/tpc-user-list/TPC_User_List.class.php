<?php

include_once('helpers.php');

class TPC_User_List {

    protected static $_instance = null;

    private $plugin_path;
    private $template_url;
    private $allowed_search_vars;

    /*
     * class constructor
     */
    public function __construct() {
        add_action('after_setup_theme', array($this, 'attach_hooks'));
        add_shortcode('tpcuserlist', array($this, 'shortcode_callback'));
        add_action('tpc_user_list_before_loop', array($this, 'add_search'));
        add_action('tpc_user_list_before_loop', array($this, 'open_wrapper'), 20);
        add_action('tpc_user_list_loop', array($this, 'user_loop'), 10, 3);
        add_action('tpc_user_list_after_loop', array($this, 'close_wrapper'), 5);
        add_action('tpc_user_list_after_loop', array($this, 'add_nav'));
        add_filter('query_vars', array($this, 'user_query_vars'));
    }

    /**
     * function to ensure only one instance of User_List is loaded or can be loaded.
     *
     * @return obj TPC_User_List single instance.
     */
    public static function get_instance() {
        if (is_null(self::$_instance)) self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * function to attach hooks.
     */
    public function attach_hooks() {
        add_action('tpcul_before_user_loop_author_title', 'tpcul_template_loop_author_avatar');
        add_action('tpcul_user_loop_author_title', 'tpcul_template_loop_author_name');
    }

    /**
     * Callback function for the shortcode
     *
     * @param  array $atts shortcode attributes
     * @param  string $content shortcode content, null for this shortcode
     * @return string
     */
    public function shortcode_callback( $atts, $content = null ) {
        global $post, $tpcul_users;

        $defaults = array(
            'query_id' => 'tpc_user_list',
            'role' => '',
            'role__in' => '',
            'role__not_in'=> '',
            'include' => '',
            'exclude' => '',
            'blog_id' => '',
            'has_published_posts' => '',
            'number' => get_option( 'posts_per_page', 10 ),
            'order' => 'ASC',
            'orderby' => 'login',
            'meta_key' => '',
            'meta_value' => '',
            'meta_compare' => '=',
            'meta_type' => 'CHAR',
            'count_total' => true,
            'taxonomy' => '',
            'terms' => '',
            'template' => 'author',
        );
        
        ob_start();
        
        $atts = wp_parse_args($atts, $defaults);
        $number = intval( $atts['number'] );
        $search = (isset($_GET['as'])) ? sanitize_text_field($_GET['as']) : false;
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $offset = ($page - 1) * $number;

        // Search args.
        $args = array(
            'query_id' => $atts['query_id'],
            'offset' => $offset,
            'number' => $number,
            'orderby' => $atts['orderby'],
            'order' => $atts['order'],
            'count_total' => $atts['count_total'],
        );

        if ($search)$args['search'] = '*' . $search . '*';

        // get and filter user list
        $tpcul_users = new WP_User_Query($args);
        $users = $tpcul_users->get_results();
        $users = apply_filters('tpc_user_list_users', $users, $atts['query_id'], $atts);

        // run actions
        do_action('tpc_user_list_before_shortcode', $post, $atts['query_id'], $atts, $users);
        do_action('tpc_user_list_before_loop', $atts['query_id'], $atts, $users);
        do_action('tpc_user_list_loop', $atts['query_id'], $atts, $users);
        do_action('tpc_user_list_after_loop', $atts['query_id'], $atts, $users);
        do_action('tpc_user_list_after_shortcode', $post, $atts['query_id'], $atts, $users);

        $output = ob_get_contents();
        
        ob_end_clean();

        return $output;
    }

    /**
     * function to loop through the users
     * 
     * @param string $query_id
     * @param array $atts Attributes from shortcode.
     * @param WP_User[]
     * @return null
     */
    public function user_loop($query_id, $atts, $users) {
        global $user, $wpdb;

        $template = isset($atts['template']) ? $atts['template'] : 'author';
        
        if (!empty($users)) {
            $i = 0;
            foreach ($users as $user){
                $user->counter = ++$i;
                $where = "WHERE user_id = '" . $user->ID . "'";
                // get number of posts			
                $count = $wpdb->get_var("SELECT COUNT(*) FROM wp_bp_activity $where");
                $user->posts_count = apply_filters('get_usernumposts', $count, $user->ID, 'post', false);
                // get number of groups
                $g_cnt = $wpdb->get_var("SELECT COUNT(DISTINCT(group_id)) FROM wp_bp_groups_members $where");
                $user->groups_count = (empty(trim($g_cnt))) ? 0 : $g_cnt;
                // get number of friends
                $f_cnt = get_user_meta($user->ID, bp_get_user_meta_key('total_friend_count'), true);
                $user->friends_count = (empty(trim($f_cnt))) ? 0 : $f_cnt;
                // setup template
                tpcul_get_template_part('content', $template);
            }
        } else {
            tpcul_get_template_part('none', $template);
        }
    }
    
    /**
     * function to register the search query vars
     *
     * @param  array $query_vars variables recognized by WordPress
     * @return array
     */
    public function user_query_vars($query_vars) {
        if (is_array($this->allowed_search_vars())) {
            foreach ($this->allowed_search_vars() as $var) {
                $query_vars[] = $var;
            }
        }
        return $query_vars;
    }

    /**
     * function to get total pages in user query
     *
     * @return integer
     */
    public function get_total_user_pages() {
        global $tpcul_users;
        $total_pages = 1;
        if ($tpcul_users && !is_wp_error($tpcul_users)) {
            $total_cnt = $tpcul_users->get_total();
            $number = intval($tpcul_users->query_vars['number']) ? intval($tpcul_users->query_vars['number']) : 1;
            $total_pages = ceil($total_cnt / $number);
        }
        return $total_pages;
    }

    /**
     * function to the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        if (!$this->plugin_path) $this->plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
        return $this->plugin_path;
    }

    /**
     * function to get the template url
     * 
     * @return string
     */
    public function template_url() {
        if (!$this->template_url) $this->template_url = trailingslashit(apply_filters('tpcul_template_url', 'tpc-user-list'));
        return $this->template_url;
    }

    /**
     * function to get allowed search args
     * 
     * @return array
     */
    public function allowed_search_vars() {
        if (!$this->allowed_search_vars) $this->allowed_search_vars = apply_filters('tpcul_user_allowed_search_vars', array('as'));
        return $this->allowed_search_vars;
    }
    
    /**
     * function to get the URL for the 'Previous' page
     *
     * @return URL string
     */
    public function get_previous_users_url() {
        global $tpcul_users;
        $previous_url = '';
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($page > 1) $previous_url = get_pagenum_link($page - 1);
        return $previous_url;
    }

    /**
     * function to get the URL for the 'Next' page
     * 
     * @return URL string
     */
    public function get_next_users_url() {
        global $tpcul_users;
        $next_url = '';
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($page < $this->get_total_user_pages()) $next_url = get_pagenum_link( $page + 1 );
        return $next_url;
    }

    /**
     * function to get current URL
     * 
     * @return URL string
     */
    public function get_current_url() {
        return apply_filters('tpcul_base_url', home_url(add_query_arg(null, null)));
    }

    /**
     * function to add search args to URL
     * 
     * @param  string $url the permalink to which we should add the allowed $_GET variables
     * @return URL string
     */
    public function add_search_args($url) {
        global $tpcul_users;
        if (!empty($_GET)) {
            $search = array_intersect_key($_GET, array_flip($this->allowed_search_vars()));
            if (!empty($search)) $url = add_query_arg((array) $search, $url);
        }
        return $url;
    }

    /**
     * function to add the search template
     */
    public function add_search() {
        tpcul_get_template_part('search', 'author');
    }

    /**
     * function to open the main container
     */
    public function open_wrapper() {
        tpcul_get_template_part('open', 'author');
    }

    /**
     * function to close the main container
     */
    public function close_wrapper() {
        tpcul_get_template_part('close', 'author');
    }

    /**
     * function to add the page navigation template
     */
    function add_nav(){
        tpcul_get_template_part('navigation', 'author');
    }


}