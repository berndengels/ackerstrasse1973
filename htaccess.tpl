
RedirectPermanent /ackerstrasse1973 http://ackerstrasse1973.loc

<IfModule mod_headers.c>
	Header set Access-Control-Allow-Origin "*"
</IfModule>

RewriteEngine On
RewriteRule  ^api/(vote|stat)/values$ action.php?controller=$1&action=values
RewriteRule  ^api/(vote|stat)/([01])$ action.php?controller=$1&value=$2
RewriteCond $1 !^(css|js|media)/ [NC]
#RewriteRule  ^(.*)$ index.php
