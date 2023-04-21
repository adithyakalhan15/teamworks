# Database Design
In this project MongoDB will be used for saving documents. And MySQL will be used for user information and and other needs. Bellow, tables, all the collections and required structure will be discussed.

## User Table
User data will be saved in sql database. There are 3 user types in the project. Admin, reader and researcher. Each of them has their own previlages and the data structure will be different for each of them.

Table Structure:

| Attribute  | Value  | Required  |  Notes |
| :------------ | :------------ | :------------ | :------------ |
| id  | int  | yes  |  This is an autoincriment value and the user id. |
| type  | string  | yes  |  the values should be admin/reader/reseacher |
| email  | string  | yes  | email should be a unique value.  |
| password  | string  | yes  | password is saved as hashed value  |
| firstName  | string  | yes  |   |
|  lastName | string  | no  |   |
| bio  | string  | no  | this is a little introduction for reader or researcher accounts.  |
|  isVerifiedEmail | int  | yes  | if the email address is verified, the value should be 1 and otherwise 0. The default value is 0.  |
|  isVerified | int  | no  | This is for researcher accounts. Only the verified user accounts can upload content. Verified - 1, not verified - 0 (default)  |
|  apiKey | string  | no  | Unique API key to access to the api.  |
| dateCreated  | DateTime  | no  |   |

## Document
