# Magento 2 Training_ProductList Module

A Magento extension which displays a list of products chosen at the backend to 
any logged in customer in the My Account section of the frontend.

Converted from Magento 1.9 [https://github.com/andrewdallow/MagentoExtensionAssignment](https://github.com/andrewdallow/MagentoExtensionAssignment)

## The handle_display Attribute

A new attribute has been added to the catalog_product_entity called handle_display.
If the attribute name 'handle_display' already exist in the database then
an exception is thrown and logged in the Magento Exception log. 

The attribute is an integer with two possible values of:
        
        0 (No): do not display in Product list
        1 (Yes): display in Product list

It is a boolean value to flag whether a product should be in the product list
or not. 

The backend user can set this property for any product by navigating in the 
 menu to:

          Catalog | Products | Edit [any product] | General
          
One then selects Yes or No for the 'Display on Product List' option and then saves 
the product to set the value.

The database is setup using the Setup/InstallData.php script.

## The Configuration Settings

One can set the 'Product List Title', the 
'Maximum Number of Products to List', and Slider Visibility in the System 
Configuration Options. They are setup in the system.xml file. These are found at:

        Stores | Configuration | Catalog | My Account Product List
        
Note: the 'Maximum Number of Products to List' option is validated 
(Training\ProductList\Model\ConfigurationValidation) so that only integer
numbers can be specified. 

A value of '0' will list no products, while a value of '10' will list up to '10' 
products. 

Default Values:

        Product List Title: Product List
        Maximum Number of Products to List: 10

Methods in the helper class 'Training\ProductList\Helper\Config' are used to
retrieve these values from the system configuration.

## The Product List Page

#### Route
The Product List can be found at the /productlist uri, defined in the routes.xml
file. It is also listed in the My Account section under the name specified 
in the System Configuration (e.g. 'Recommended Products').

This page can only be accessed when a customer is logged on, achieved by 
checking the session object if the customer is logged in. 

Training\ProductList\Controller\Index is also responsible for rendering the default
index page of productlist. 

#### Product List

The Product list block, Training\ProductList\Block\ListProduct, extends the Magento 
ListProduct block and overrides the setProductCollection() and getLoadedCollection 
methods to only retrieve a product collection where 'handle_display' is equal to 1.

The display of the list is adapted from the Magento 2 default luma theme.
The template list.phtml can display products in either the default 'Grid'
layout or as a Slider. The slider uses the 3rd party javascript called Slick, 
but is otherwise based on the grid format. 

The Training\ProductList\Block\Toolbar Block for the product list has also 
been customised by extending the \Magento\Catalog\Block\Product\ProductList\Toolbar
Block to fix the view options to 'Grid' and 'Slider'. Clicking their corresponding 
links sets the 'product_list_mode' parameter in the uri and displays the product list in 
the chosen way. 

The Layout of the blocks are defined in the productlist_index_index.xml file in 
the view/layout directory. A custom stylesheet has also been added for the slider,
along with external CDN links to the Slick javascript library and css. 