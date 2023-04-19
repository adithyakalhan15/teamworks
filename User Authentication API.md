# Documentation - User Authentication API
This api is used for authentication, and other user based tasks. The api provides following services.
1. Account creation
2. Account login
3. Request password reset for user
4. Reset password
5. Get user access token
6. Validate user AccessToken
7. Get user prevelages
8. Get user settings
9. Set user settings
10. Delete user account
11. Logout
12. Account email verification

## Account Creation
The api support two types of user accounts. The reader account and researcher account. Each account has prevelages to access his account.
The reader account is the most basic account to create and can be used to created within minutes, while the researcher account required administration approval. 

To request from api to create a reader account, following request can be made.

`http://example.com/api/create/researcher-account`

##### API Request Parameters
|Parameter   | Values  | Required | Notes|
| ------------ | ------------ | ------------ | ------------ |
|firstName   | text  | Yes   |   |
|lastName   | text  | Yes  |   |
|email   | (text) email  | Yes  |   |
|password  | text  | Yes  |   |
|passwordConfirm  | text  | Yes  | - |


##### Response Values
|Error| Values  | Notes|
| ------------ | ------------ | ------------ | ------------ |
|error   | boolean  | error will be true if there was any error occured   |
|message  | string  | if there is an error, this will show a readable message  |
|apiKey   | string  | This key can be stored with in an variable or cookie and can be used to call requests that required authentication |


##### Example - jQuery
```javascript
$.post("api/user-manager/create/researcher-account", {
    	firstName: "Andrew",
    	lastName: "Andrew",
    	email: "email@example.com",
    	password: "mypassword@123",
    	passwordConfirm: "mypassword@123"
    }, (data)=>{
    	data = JSON.parse(data);
    	//handle errors
    	if (!data.error){
    		//process and show user data. save the api key for further requests.
    	}else{
    		console.error(data.message);
    	}
    }
    })

```
