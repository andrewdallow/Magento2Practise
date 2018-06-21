# Ecommistry Blog Module Example

Example of a Magento 2 Blog Module with Create/Read/Update/Delete functionality.

The example also shows how to install a table for the blog with an install
script, then later, Upgrade the existing table with an update_time column 
and a column referencing the id of a topic. A new Topic table is also added. 

## Upadate 1.0.2
Added Event Observer Ecommistry\Blog\Observer\SaveBlogObserver which is executed 
when a blog entity is saved. this is defined in the events.xml file as 
'ecommistry_blog_save_after'. When the event is triggered by the Blog AbstractModel 
a message is printed to debug.log. Mke sure debug logging is enabled in the admin 
area beforehand. 

Added a cron job with class \Ecommistry\Blog\Cron\AddPost which adds a blog post 
to the database when using the execute method. This Cron job is scheduled in the 
etc/crontab.xml to run every minute. 

In the case of not having Crontab installed, using the Magento cli command 'cron:run' will 
scehduale this cron job in the database and then running the command again will 
execute the cron job. 

## Update 1.0.2
Updated to use blog repository interface instead of Factories. 

The Blog repository interface has also been added to the Magento webapi using 
the etc/webapi.xml file. API calls can be accessed through /rest/V1/blog and 
include GET, PUT, POST, and DELETE calls. 

Added filtered product list using product repository on url /blog/index/products 
which displays products with the following conditions:

        Filters: 'price' > 10.00 AND 'price' < 20.00 AND 'visibility' === 4 AND 'status' === 1
        Order By: 'price', 'desc'
        Page Size: 6
        
## Update 1.0.1

### System Configuration
The limit for the number of blog posts to show can now be set in the admin 
configuration area:

        Stores | Configuration | Ecommistry | Blogs | Blog Settings

### Ui Component

The Magento UI components are a set of pre-made User Interface elements such as
tables, forms, buttons, filters, and several other elements. They can be used
both in the frontend (requires custom styles) and admin area (styles provided). 

Ui Components are classified under two categories:
* Basic Components
    * [Listing Component (or tables)](https://devdocs.magento.com/guides/v2.2/ui_comp_guide/components/ui-listing-grid.html)
    * [Form Component](https://devdocs.magento.com/guides/v2.2/ui_comp_guide/components/ui-form.html)
 * Secondary Components
    * All other components such as buttons, filters, dialogs etc.
 
 Magento recommends using the UI components as much as possible because they 
 work well together, communicating with each other via the uiRegistry that tracks 
 their asynchronous initialisation. Adding new features is as easy as extending 
 existing components. This allows one to reuse code instead of recreating it for 
 each usage.  
 
 UI components are defined by:
  * XML Declaration - configuration settings and inner structure.
  * JavaScript - asynchronous frontend dynamic behaviour 
  * Related Templates - HTML templates of components. 
  
 #### Blog Example
 
 A Magento UI Grid component has been implemented in the admin area of this module,
 displaying a table of all blog posts in the database. 
 
 Steps to creating the UI Grid Component for Blog:
 1. Create the Index controller on the admin area
  
        Ecommistry\Blog\Controller\Adminhtml\Index\Index 
 
 2. Create the 'blog' route (routes.xml) and 'menu' (menu.xml) item for 
    the admin area.
 
 3. Create the grid collection model for the ecommistry_blog table which extends 
    Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
 
        Ecommistry\Blog\Model\ResourceModel\Blog\Grid\Collection
 
 4. Register the Collection as a data source in the di.xml file.
     ```
    <type name="Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory">
        <arguments>
            <argument name="collections" xsi:type="array">
                <item name="ecommistry_blog_grid_data_source" xsi:type="string">Ecommistry\Blog\Model\ResourceModel\Blog\Grid\Collection</item>
            </argument>
        </arguments>
    </type>
     ```
 5. Create the layout file for admin area blog_index_index.xml specifying that the UI component
    should be inserted on the content container of the page. 
    
        <uiComponent name="ecommistry_blog_grid"/>
 
 6. Create the UI Component Configuration file in view/adminhtml/ui_component
    with the same name specified in the layout file, 'ecommistry_blog_grid'.        
 
 7. Configure the Grid or Listing with the listing tags, specifying data source,
    grid columns, and other secondary components.
    
 #### Extras:
 Created a Topic Ui component which extends the Column Component and takes 
 the topic_id from the ecommistry_blog table and returns the corresponding topic 
 name. 
 
        Ecommistry\Blog\Ui\Component\Listing\Columns\Topic
        
 Also added CRUD operations to admin blog controls using the Magento UI components. 