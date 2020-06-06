# Socialsite
A web portal to illustrate the working of a social networking site developed using PHP and MySql

-------------------------------------------------------------------------------------------------------

Problem statement:
To develop a social connection module using PHP and MySQL.

------------------------------------------------------------------------------------------------------

The Database consists of the following tables:

•login :
	To store the details of the user. 
	The attributes are profile_id which is auto generated, username, password and email of the user.
•Request:
	To store the friend requests that are sent among the users. 
	The attributes are profile_id and sent_to which are the ids of the two users whose request is pending. 
	Upon the accept of the request by the user the particular row id deleted and the details of the two users are inserted into the friends table.
•Friend:
	To store the details of the users who are friends of each other. 
	The attributes are profile_id1 and profile_id2.
•Updatestatus :
	To store the real time updates/posts of the user. 
	The attributes are profile_id, msg, username and time.

--------------------------------------------------------------------------------------------------------
Naming Convention:

A query is named after its function. Like the ‘$find’ is used to validate a user and the result after the execution of the query in stored in ‘$find_res’ which denotes it as result of ‘$find’ query.

