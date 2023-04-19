# Guid to Deploying the microservice
This guid will tell how the microservices should be deployed manually with apache server. For each server the desired url and the config file code will be given bellow.

## Deploying the microservice "Users"
The microservice users is a laravel project and it will be deployed in following url.

    http://localhost/api/user

We need to pointer the location of public folder of the laravel project. To achieve the result with apache server, add the following:

```apacheconf
Alias "/api/user"  "C:/Users/namin/Desktop/usjpub/teamworks/laravel/usj_pub/public/"

<Directory "C:/Users/namin/Desktop/usjpub/teamworks/laravel/usj_pub/public/">
	Options +Indexes +FollowSymLinks +MultiViews
	AllowOverride all
	Require all granted
	allow from all
</Directory>
```

