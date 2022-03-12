# Web-Programming

## Project : Digital Library

Github : https://github.com/saikiransangam/Web-Programming

### Architecture

![architecture](https://github.com/saikiransangam/Web-Programming/blob/master/images/architecture.png)


                    


3. Data

The dataset for the Thesis and dissertations search engine. This dataset contains  around 3990 folders.Each folder contains json files, text and pdf documents. We have to use a for loop to obtain the fields from each json file. Each json file contains various fields related to books like handle number, title, author, department, degree grantor, degree level, degree name, description_abstract, publisher, source url and etc..I have used curl command to index all the json documents data into the elastic search. The content of the file is in indexingETD.php. Then I run the view of the data, it will go into our elastic search.I have written a query for my search functionality when we searched for a word in a search engine the results should be displayed using multiple fields like title, degree name, author, abstract, publisher, type, degree level and contributor department. It will display the word which is there in all the above fields. Similarly I have implemented the advanced search here I have written a query which multi matches with the fields of title and author.

4. Implementations

4.1 Search box and search button
     I have implemented a search box and search button using HTML and CSS. It’s the landing page of the website. You can find the code in the index.php. Here's the landing page  

![Implementation]()
      
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
