# wordpress-user-list-plugin


*Headbook* is a simple WordPress project to show a list of the registered BuddyPress users, along with their avatars, number of activity items they have posted, number of groups they belong to, as well as number of friends they have.

## Tools
<ul><li>WordPress v5.7</li><li>BuddyPress plugin v7.2.1</li><li>BP Default Data plugin v1.3.1 <span class="has-inline-color has-vivid-red-color"><strong>*</strong></span></li><li>MiNNaK theme v2.1.4 <span class="has-inline-color has-vivid-red-color"><strong>*</strong></span></li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong><span class="has-inline-color has-vivid-red-color">*</span></strong> <em><strong>modified/enhanced to fit the purpose of this project</strong></em></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Challenges</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>Structuring the User List plugin in a way that is easy to follow.</strong> While this was not completely achieved (as I will explain in the last section of this post), I tried my best to make the plugin as simple as possible. This meant finding the balance between the right thing to do (from the Software Engineering perspective) and the objective and timeline of this project.</li><li><strong>Finding and customizing the right theme.</strong> I tried not to waste too much time on this part, as it was not explicitly mentioned in the assessment description. However, finding a simple theme and customizing it in a way that does not affect the plugin or cause issues or add an unnecessary overhead was not as simple as expected.</li><li><strong>Modifying BP Default Data.</strong> This was needed in order to support 100 users and increase the maximum number of friend connections between them. While this was not a difficult task, it was not expected. </li><li><strong>Adding the search bar.</strong> This also was not included in the assessment description. However, I thought it was necessary. Adding it required looking for the right source and flow of execution online and trying to inject that logic in the new plugin.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Decisions &amp; Assumptions</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>Not including profile data.</strong> Although it made sense to make the user details clickable in order to redirect to the user profile, I thought it would take a longer time to implement such functionality, while the objective was the plugin itself rather than the website as a whole.</li></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>Technical "Regrets"</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>More secure search functionality.</strong> I think a lot could have been done this area to sanitize the user input as well as the GET parameters to make it less prone to SQL Injections. This is probably the most important thing that I would have done differently had I had more time.</li><li><strong>Better code documentation.</strong> Although I tried to add descriptive DocStrings for the functions, a lot could have been done differently in this area. Commenting on the function contents would probably have made the code more readable.  </li><li><strong>More Object-Oriented approach.</strong> If I had more time, I would probably have broken the TPC_User_List class further into smaller classes. This is mostly because that class' functionality can be broken into categories like user details, activity details, group details, etc.</li><li><strong>Better search functionality. </strong>I think adding a drop-down menu to allow the user to search by group name or to find the friends of a particular user would have been useful.</li></ul>
<!-- /wp:list -->
