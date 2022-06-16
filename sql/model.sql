------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: review
------------------------------------------------------------
CREATE TABLE public.review(
	review_id      SERIAL NOT NULL ,
	review_value   CHAR (5)  NOT NULL ,
	review_text    SERIAL NOT NULL  ,
	CONSTRAINT review_PK PRIMARY KEY (review_id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: match_result
------------------------------------------------------------
CREATE TABLE public.match_result(
	match_id      SERIAL NOT NULL ,
	score_match   VARCHAR (50) NOT NULL ,
	duration      FLOAT  NOT NULL ,
	best_player   VARCHAR (50) NOT NULL  ,
	CONSTRAINT match_result_PK PRIMARY KEY (match_id) ,
	CONSTRAINT match_result_AK UNIQUE (best_player)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: sport
------------------------------------------------------------
CREATE TABLE public.sport(
	sport_name   VARCHAR (50) NOT NULL  ,
	CONSTRAINT sport_PK PRIMARY KEY (sport_name)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: match
------------------------------------------------------------
CREATE TABLE public.match(
	match_id                SERIAL NOT NULL ,
	number_max_player       INT  NOT NULL ,
	number_min_player       INT  NOT NULL ,
	date                    DATE  NOT NULL ,
	hour                    TIMESTAMP  NOT NULL ,
	adress                  VARCHAR (50) NOT NULL ,
	duration                FLOAT  NOT NULL ,
	price                   FLOAT  NOT NULL ,
	registered_count        INT  NOT NULL ,
	title                   VARCHAR (50) NOT NULL ,
	age_range               VARCHAR (50) NOT NULL ,
	match_description       VARCHAR (50) NOT NULL ,
	winner                  VARCHAR (50) NOT NULL ,
	organizer_id            VARCHAR (50) NOT NULL ,
	sport_name              VARCHAR (50) NOT NULL ,
	match_id_match_result   INT  NOT NULL  ,
	CONSTRAINT match_PK PRIMARY KEY (match_id) ,
	CONSTRAINT match_AK UNIQUE (organizer_id)

	,CONSTRAINT match_sport_FK FOREIGN KEY (sport_name) REFERENCES public.sport(sport_name)
	,CONSTRAINT match_match_result0_FK FOREIGN KEY (match_id_match_result) REFERENCES public.match_result(match_id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: town
------------------------------------------------------------
CREATE TABLE public.town(
	town_id   SERIAL NOT NULL ,
	town      VARCHAR (5) NOT NULL  ,
	CONSTRAINT town_PK PRIMARY KEY (town_id)
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
	age                   INT  NOT NULL ,
	number_match_played   INT  NOT NULL ,
	health                VARCHAR (50) NOT NULL ,
	review_id             INT  NOT NULL ,
	town_id               INT  NOT NULL  ,
	CONSTRAINT player_PK PRIMARY KEY (mail)

	,CONSTRAINT player_review_FK FOREIGN KEY (review_id) REFERENCES public.review(review_id)
	,CONSTRAINT player_town0_FK FOREIGN KEY (town_id) REFERENCES public.town(town_id)
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


------------------------------------------------------------
-- Table: play
------------------------------------------------------------
CREATE TABLE public.play(
	match_id        INT  NOT NULL ,
	mail            VARCHAR (50) NOT NULL ,
	is_registered   BOOL  NOT NULL ,
	wait_response   BOOL  NOT NULL ,
	team_a          BOOL  NOT NULL ,
	team_b          BOOL  NOT NULL  ,
	CONSTRAINT play_PK PRIMARY KEY (match_id,mail)

	,CONSTRAINT play_match_FK FOREIGN KEY (match_id) REFERENCES public.match(match_id)
	,CONSTRAINT play_player0_FK FOREIGN KEY (mail) REFERENCES public.player(mail)
)WITHOUT OIDS;



