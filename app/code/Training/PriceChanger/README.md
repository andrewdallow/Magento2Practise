# Price Changer Plugin

Plugin used on the getPrice() function of \Magento\Catalog\Model\Product to 
alter the price to reflect a site wide product discount. 

These changes are also logged in a custom debug log file 'var/log/custom_debug.log' 
by changing the preference for the Debug handler class to a custom model Model\DebugHandler.
This was done in the etc/di.xml file. 