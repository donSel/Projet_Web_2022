------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------

DROP TABLE IF EXISTS review,match_result,sport,match,town,player,score,play CASCADE;

------------------------------------------------------------
-- Table: match_result
------------------------------------------------------------
CREATE TABLE public.match_result(
	match_id      SERIAL NOT NULL ,
	score_match   VARCHAR (50) NOT NULL ,
	duration      TIME  NOT NULL ,
	best_player   VARCHAR (50) ,
	winner        VARCHAR (50) NOT NULL ,
	CONSTRAINT match_result_PK PRIMARY KEY (match_id) --,
	--CONSTRAINT match_result_AK UNIQUE (best_player)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: review
------------------------------------------------------------
CREATE TABLE public.review(
	review_id      SERIAL NOT NULL ,
	review_value   INT  NOT NULL , -- -1 => no review, 1 => 1 star, 2 => 2 stars, 3 => 3 stars, 4 => 4 stars, 5 => 5 stars
	review_text    VARCHAR (50) ,
	CONSTRAINT review_PK PRIMARY KEY (review_id)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: town
------------------------------------------------------------
CREATE TABLE public.town(
	town_id   SERIAL NOT NULL ,
	town      VARCHAR (50) NOT NULL  ,
	CONSTRAINT town_PK PRIMARY KEY (town_id)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: sport
------------------------------------------------------------
CREATE TABLE public.sport(
	sport_id     SERIAL NOT NULL ,
	sport_name   VARCHAR (50) NOT NULL  ,
	CONSTRAINT sport_PK PRIMARY KEY (sport_id)
)WITHOUT OIDS;




------------------------------------------------------------
-- Table: player
------------------------------------------------------------
CREATE TABLE public.player(
	mail                  VARCHAR (50) NOT NULL ,
	password              VARCHAR (50) NOT NULL ,
	first_name            VARCHAR (50) NOT NULL ,
	last_name             VARCHAR (50) NOT NULL ,
	photo_url             VARCHAR (50) NOT NULL ,
	age                   INT  NOT NULL , -- -1 => no value
	health                INT  NOT NULL  , -- -1 => no value, 0 => beginner, 1 => enthusiast, 2 => confirmed, 3 => professional
	number_match_played   INT  NOT NULL ,
	review_id             SERIAL NOT NULL ,
	town_id               INT  NOT NULL  ,
	CONSTRAINT player_PK PRIMARY KEY (mail)

	,CONSTRAINT player_review_FK FOREIGN KEY (review_id) REFERENCES public.review(review_id)
	,CONSTRAINT player_town_FK FOREIGN KEY (town_id) REFERENCES public.town(town_id)
)WITHOUT OIDS;




------------------------------------------------------------
-- Table: match
------------------------------------------------------------
CREATE TABLE public.match(
	match_id                SERIAL NOT NULL ,
	number_max_player       INT  NOT NULL ,
	number_min_player       INT  NOT NULL ,
	date                    DATE  NOT NULL ,
	hour                    TIME  NOT NULL ,
	address                  VARCHAR (50) NOT NULL ,
	price                   FLOAT  NOT NULL ,
	registered_count        INT  NOT NULL ,
	title                   VARCHAR (50) NOT NULL ,
	age_range               VARCHAR (50) NOT NULL ,
	match_description       VARCHAR (50) NOT NULL ,
	duration                TIME  NOT NULL ,
	organizer_id            VARCHAR (50) NOT NULL ,
	sport_id                INT  NOT NULL ,
	match_id_match_result   INT  NOT NULL ,
	town_id                 INT  NOT NULL  ,
	is_finished   BOOL  NOT NULL ,
	CONSTRAINT match_PK PRIMARY KEY (match_id) --,
	--CONSTRAINT match_AK UNIQUE (organizer_id)

	,CONSTRAINT match_sport_FK FOREIGN KEY (sport_id) REFERENCES public.sport(sport_id)
	,CONSTRAINT match_match_result0_FK FOREIGN KEY (match_id_match_result) REFERENCES public.match_result(match_id)
	,CONSTRAINT match_town1_FK FOREIGN KEY (town_id) REFERENCES public.town(town_id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: play
------------------------------------------------------------
CREATE TABLE public.play(
	match_id        INT  NOT NULL ,
	mail            VARCHAR (50) NOT NULL ,
	is_registered   BOOL  NOT NULL ,
	wait_response   BOOL  NOT NULL ,
	role       INT  NOT NULL  , -- 0 => Organizer, 1 => Player, 2 => player + Organizer
	team       INT  NOT NULL  , -- 0 => team_A, 1 => team_B, 2 => no_team
	CONSTRAINT play_PK PRIMARY KEY (match_id,mail)

	,CONSTRAINT play_match_FK FOREIGN KEY (match_id) REFERENCES public.match(match_id)
	,CONSTRAINT play_player0_FK FOREIGN KEY (mail) REFERENCES public.player(mail)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: score
------------------------------------------------------------
CREATE TABLE public.score(
	score_id       SERIAL NOT NULL ,
	scoring_time   TIMESTAMP  NOT NULL ,
	mail           VARCHAR (50) NOT NULL ,
	match_id       INT  NOT NULL  ,
	CONSTRAINT score_PK PRIMARY KEY (score_id)

	,CONSTRAINT score_player_FK FOREIGN KEY (mail) REFERENCES public.player(mail)
	,CONSTRAINT score_match0_FK FOREIGN KEY (match_id) REFERENCES public.match(match_id)
)WITHOUT OIDS;




