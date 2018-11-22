# web 服务器配置

Nginx
```conf
server {
        listen       80;
        server_name  www.essagent.com;
        root   "D:/www/company/ess_agent/home/public";

        location / {
            index  index.php index.html index.htm;
            if (-e $request_filename) {
                break;
            }
            if (!-e $request_filename) {
                rewrite ^/(.*)$ /index.php/$1 last;
                break;
            }
        }


        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}

server {
        listen       80;
        server_name  admin.essagent.com;
        root   "D:/www/company/ess_agent/admin/public";

        location / {
            index  index.php index.html index.htm;
            if (-e $request_filename) {
                break;
            }
            if (!-e $request_filename) {
                rewrite ^/(.*)$ /index.php/$1 last;
                break;
            }
        }


        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
}
```
Apache
```conf

<VirtualHost *:80>
    DocumentRoot "C:\wamp\www\ess_agent\home\public"
    ServerName www.agent.com
    ServerAlias
  <Directory "C:\wamp\www\ess_agent\home\public">
      DirectoryIndex index.html index.htm index.php index.php3
      Options FollowSymLinks ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
      Require all granted
  </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:\wamp\www\ess_agent\admin\public"
    ServerName admin.agent.com
    ServerAlias
  <Directory "C:\wamp\www\ess_agent\admin\public">
      DirectoryIndex index.html index.htm index.php index.php3
      Options FollowSymLinks ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
      Require all granted
  </Directory>
</VirtualHost>
```
apache rewrite
```conf
RewriteEngine On
RewriteBase /
RewriteCond $1 !^(js|images|css|favicon)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
#RewriteRule ^/(.*\.(jpg|png|gif|ico))$ /$1 [L]
RewriteRule ^(.*)$ /index.php?$1 [L]
```