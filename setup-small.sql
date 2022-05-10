-- Justin Nam jnam17
-- Cameron Marcus cmarcus9
-- setup-small.sql script


-- In case we've run this script before, remove old tables before we re-create them
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Critic;
DROP TABLE IF EXISTS IsIn;
DROP TABLE IF EXISTS Person;
DROP TABLE IF EXISTS Movie;

CREATE TABLE Person
       (
       personID  VARCHAR(10) PRIMARY KEY,
       primaryName    VARCHAR(40),
       birthYear     YEAR,
       deathYear  YEAR,
       primaryProfession    VARCHAR(100),
       knownForTitles VARCHAR(100));


LOAD DATA LOCAL INFILE
'small-person.txt'
INTO TABLE Person
(personID, primaryName, birthYear, deathYear, primaryProfession, knownForTitles);

CREATE TABLE Movie
        (movie VARCHAR(40),
        production_year YEAR,
        production_budget INT,
        domestic_box_office INT,
        international_box_office INT,
        rating VARCHAR(10),
        creative_type VARCHAR(40),
        movie_source VARCHAR(100),
        production_method VARCHAR(40),
        genre VARCHAR(40),
        sequel DOUBLE,
        running_time DOUBLE,
        movieID VARCHAR(20) PRIMARY KEY,
        isAdult DOUBLE,
        genres VARCHAR(100));

LOAD DATA LOCAL INFILE
'small-movie.txt'
INTO TABLE Movie
(movie, production_year, production_budget,domestic_box_office, international_box_office,rating,creative_type,movie_source, production_method, genre, sequel, @vrunning_time, movieID, isAdult, genres)
SET running_time = NULLIF(@vrunning_time, '');

CREATE TABLE Critic
        (critic_name VARCHAR(30),
        publisher_name VARCHAR(30),
        PRIMARY KEY(critic_name, publisher_name)
        );

LOAD DATA LOCAL INFILE
'small-critic.txt'
INTO TABLE Critic
(critic_name, publisher_name);

CREATE TABLE Review
        (critic_name VARCHAR(30),
        top_critic BOOLEAN,
        publisher_name VARCHAR(30),
        review_type VARCHAR(15),
        review_score VARCHAR(10),
        review_date DATE,
        review_content VARCHAR(256),
        movie_info VARCHAR (256),
        critics_consensus VARCHAR (256),
        production_company VARCHAR(30),
        tomatometer_status VARCHAR(15),
        tomatometer_rating DOUBLE,
        tomatometer_count DOUBLE,
        audience_status VARCHAR(30),
        audience_rating DOUBLE,
        audience_count DOUBLE,
        tomatometer_top_critics_count DOUBLE,
        tomatometer_fresh_critics_count DOUBLE,
        tomatometer_rotten_critics_count DOUBLE,
        movie_name VARCHAR(40),
        movieID VARCHAR(20),
        PRIMARY KEY(movieID, critic_name, publisher_name),
        FOREIGN KEY(movieID) REFERENCES Movie(movieID) ON DELETE CASCADE ON UPDATE CASCADE
        );

LOAD DATA LOCAL INFILE
'small-review.txt'
INTO TABLE Review
(critic_name,top_critic,publisher_name,review_type,@vreview_score,review_date,@vreview_content,movie_info,critics_consensus,production_company,tomatometer_status,tomatometer_rating,tomatometer_count,audience_status,audience_rating,audience_count,tomatometer_top_critics_count,tomatometer_fresh_critics_count,tomatometer_rotten_critics_count,movie_name,movieID)
SET
review_score = NULLIF(@vreview_score, ''),
review_content = NULLIF(@vreview_content, '');


CREATE TABLE IsIn
        (movieID VARCHAR(20),
        ordering INTEGER,
        personID VARCHAR(10),
        category VARCHAR(40),
        job VARCHAR(40),
        characters VARCHAR(100),
        PRIMARY KEY(movieID, ordering, personID),
        FOREIGN KEY(movieID) REFERENCES Movie(movieID) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY(personID) REFERENCES Person(personID) ON DELETE CASCADE ON UPDATE CASCADE
        );

LOAD DATA LOCAL INFILE
'small-isin.txt'
INTO TABLE IsIn
(movieID, ordering, personID, category, job, characters);

