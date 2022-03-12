# Web-Programming

## Project : Digital Library

Github : https://github.com/saikiransangam/Web-Programming

1. Milestone Accomplishments

Milestone - 1


Fulfilled
#specification
Description
Yes
1
The website should provide a search box at the landing page. The searching function may not be working at this stage, and there should be a search button next to the search box. 
Yes
2
Users should be able to register new accounts using email addresses.
Yes
3
Passwords must be encrypted before storing in the database.
Yes
4
Users cannot register duplicate accounts using the same email address, or phone number.
Yes
5
Users should be able to log into your website using the accounts they registered.
Yes
6
Users should be able to reset their passwords if they forget it.
Yes
7
Users should be able to change their passwords if they want.
Yes
8
The website should have a homepage for each user, where they can view their profiles, change passwords, and update information. 



Milestone - 2


Fulfilled
#specification
Description
Yes
1
Users should be able to get a confirmation email containing a link to verify their email, OR they should receive a temporary password to login and change their passwords.
Yes
2
The website has an “Advanced Search” function so users can search by specifying values for at least two fields simultaneously.
Yes
3
The website should index at least 2000 “documents” (a document can be an ETD).
Yes
4
Users can query the search engine without logging in.
Yes
5
The search engine accepts a text query in the search box and returns results on the search engine result page (SERP). 
Yes
6
Each item in SERP should link to a page for a document.
Yes
7
The search engine should display the number of returned items on top of search results.
Yes
8
The SERP should also contain a search box on the top



Milestone - 3


Fulfilled
#specification
Description
Yes
1
The search engine should show the actual keywords after filtering on the SERP.
Yes
2
The search engine can prevent XSS vulnerability by removing tags existing in the query and show the actual term (after sanitization) shown on the top of the SERP.
Yes
3
A regular user should be able to insert a new entry (document) and search engines will index it.
Yes
4
The search engine can return paginated results.
Yes
5
The search engine should have a summary page for each thesis, the summary page should display at least the following 8 fields, when available: title, author, university, department, year, advisor, academic field (e.g., Computer Science), and abstract. Users can click each item on SERP and go to this summary page for each thesis.
Yes
6
Users can switch back to the search results from the summary page.
Yes
7
In the summary page, below the metadata, there is a discussion board, where users can input a claim extracted from the thesis and add comments. The layout looks like this:




Milestone 4:


Fulfilled
#specification
Description
Yes
1
The search engine can highlight the matched terms on SERP.
Yes
2
Users can delete items from their favorite list.
Yes
3
Items in the favorite lists should be an ID followed by the title, year, and author linked to the summary page of the document.
Yes
4
Logged in users can “vote” a claim discussion. Specifically,

 a. There should be a “vote” button for each claim on the document summary page. 

b. A user who logged in can toggle the like button if he changes his mind.

c. The total number of “up vote” minus the “down vote” is shown.
Yes
5
The search engine implements speech-to-text.
Yes
6
The search engine implements spell check.
Yes
7
There is a button from which users can download the PDF from local storage from the summary page or from the SERP. For ETDs with multiple PDFs, the best solution is to zip them for download. But the basic requirement is to download one of them. 




2. Architecture


                    


3. Data

             Professor gave us the dataset for the Thesis and dissertations search engine. This dataset contains  around 3990 folders.Each folder contains json files, text and pdf documents. We have to use a for loop to obtain the fields from each json file. Each json file contains various fields related to books like handle number, title, author, department, degree grantor, degree level, degree name, description_abstract, publisher, source url and etc..I have used curl command to index all the json documents data into the elastic search. The content of the file is in indexingETD.php. Then I run the view of the data, it will go into our elastic search.I have written a query for my search functionality when we searched for a word in a search engine the results should be displayed using multiple fields like title, degree name, author, abstract, publisher, type, degree level and contributor department. It will display the word which is there in all the above fields. Similarly I have implemented the advanced search here I have written a query which multi matches with the fields of title and author.

4. Implementations

4.1 Search box and search button
     I have implemented a search box and search button using HTML and CSS. It’s the landing page of the website. You can find the code in the index.php. Here's the landing page  

      
4.2 Account registration
      I have used HTML and CSS to make an account registration form and we are storing account registration data in Mysql database.I used backend as PHP, I have done my project in PHP from scratch. In this form we have first name , last name, email, password, confirm password.the  Email is the unique id, with the same email users can’t register. If a user tries with the same email he gets a message that email already exists. password and confirm password need to be the same if not through error. password allows special characters, alphabets and numbers. Once we submit the register button, email will be sent for email verification and the user can login, without email verification an error message will be shown “your email has not verified”. I have used PHPMailer library(PHPMailer is a code library to send emails safely and easily via PHP code from a web server.)You can find the code in the register.php. Here’s the registration page.


4.3 Account login
         I have used HTML and CSS to make a login form and in this form while we enter email and password that should match with the database, if not it throws an error message saying “Incorrect info..! Enter again…! or your email has not verified”. After registration the user must verify the email if not the user can’t login into his account and show an error message.You can find the code in the login.php. Here’s the login page.

4.4 Forget password and reset password 
      I have implemented a forget password and reset password if the user forgets the password while login into his account. Email should be entered then a new password will be generated and sent to email then he can login with the new generated password and can change after login into his account by getting into profile. I have used the PHPMailer library to send emails(PHPMailer is a code library to send emails safely and easily via PHP code from a web server.)You can find the code in the forgotpass.php. Here’s the forget password page.

4.5 Users’ homepage
     Authenticated users i.e the users who logged in are able to see the home page.User’s homepage contains a search box, search button, speech 2 text, advance search, uploading new documents, favourites list, profile and logout options. You can find the code in the home.php. Here’s the home page.


4.6 Main search function
      Main search functionality works for the people who are not logged in to the website and as well as to the authenticated users.The key components that connect the front end of my search engine to ElasticSearch are the various functions that I’ve used like the search, isset and variables like $GET. Further, in order to implement the search function, I have used various Elasticsearch functions like index (gives the index name indexingETD), type (document), multi match which takes various fields at once and implements the search fields (what are the specified fields). The above advanced search function takes the two fields ‘title’ , ‘authors’,’degree grantor’ and gives back the search results according to them. The results are then generated in a separate page and I’ have echoed the table to display the results. This is implemented in the results.php.

4.7 Advanced search
      Advance search functionality will be available only for the users who logged in to the website.The advanced search has various fields where the users can filter their search results by book title, author. The advanced search is implemented similar to the main search function using the multi match function. 
'multi_match' => ['query'=>$q,‘fields’[‘title‘,‘contributor_author‘,’degree_grantor’].The content can be found in the file adv.php. Here’s the advanced search page.


4.8 SERP
       SERP contains the search box with search word, search button, total no of results of search word, pagination per page 10 results, advance search, favourites list, and home options. It shows the matched term documents in the SERP page. In the results it shows the title, author, degree grantor, pdf details,abstract information and a download option.The search terms are also highlighted and shown in the results. It can be found in results.php file.Here’s the SERP(results) page.

      

4.9 Document summary page
      Document summary page shows the document number(handle Id)  with the following information contributor_author, contributor_committeechair, contributor_committeemember, contributor_department, date_accessioned, date_adate, date_available, date_issued, date_rdate, date_sdate, degree_grantor, degree_level, degree_name, description_abstract, description_provenance, handle, identifier_other, identifier_sourceurl, identifier_uri, publisher, relation_haspart, rights, subject, title, type and also with back button to redirect to search results. You can find this code in results.php. Here’s the summary page.




4.10 XSS vulnerability filtering
    In order for the SERP to display the actual term (after sanitization) on top, I’ve used the csrf() token field and strip_tags() function to filter the tags and display the word. The content of the functionality can be found in the results.php file.

4.11 Insert a new entry
        Insert a new entry functionality will be available only for the authenticated users who logged in to the website.The users can add any pdf file to the database only if they login. There’s a message that says if the books have been successfully indexed. The users can add a book title, author’s name and the book’s ISBN number to the elasticsearch.The content of this can be found in the upload_data.php file. Here’s the insert new entry page.


4.12 Pagination
       Pagination is based on the concept of how the control module fetches the total results from the Model (data), then sorts the first N elements and fetches another N results when the user clicks the next page link. I’ve used a List, JavaScript, Bootstrap and Ajax to implement the pagination. This functionality is implemented in results.php file.Here you can see the pagination.


4.13 Highlighting search terms
      Highlighting search terms have implemented this functionality using javascript mark color. This will find the words that we search in the search engine and displays with the highlighted color.This functionality is implemented in both results.php and adv.php files
Here you can see the highlighted search terms.



4.14 Save/delete items to favorite list
        This functionality will be available only for the users who are logged in to the website.I’ve created a favourites database in order for the users to save their favorite books. The saved favorite items are again redirected to an external link where There's a much detailed description of the result. The user can delete the items from the favorites. You can find it in favourite.php file
Here you can see the favourites list.

4.15 Discussion board
       Discussion board page was designed using HTML and CSS. It consists of claim #number of claims and by username and with can you reproduce this claim? With options yes or no. Then proof or experiments: with source code, datasets, experiment results and with button add claim. Only authenticated users can submit a claim; it is shown under the summary of that particular document with information. You can find this code in saveClaim.php.Here you can see the discussion board .


4.16 Voting
         In the summary page, we do have claims already added ones there we can vote for like or dislike the claim. This can be done by the both users and if they change their mind users can unlike or remove dislike buttons. I’ve created a like_dislike database table to save and show the number of like and dislikes for a particular claim.


4.17 Spell check
        Spell check is implemented  within the query. Here is it how i implemented “suggest” => [“mytermsuggestor” => [“text => $query_str, “term” => [ “field” => “title”]]. It’s do fuzzy search and finds out the most matched term with mytermsuggestor and then it shows the matching results in results page.
4.18 Speech-to-text API
      I have implemented the speech to text API functionality in my welcome, home and results pages. I’ve used HTML5 Speech Recognition API in order to implement this. The code content is available in my home..php and index.php and results.php.
