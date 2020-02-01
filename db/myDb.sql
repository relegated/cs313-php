CREATE TABLE user_account (
    user_id serial PRIMARY KEY
    ,first_name VARCHAR(255) NOT NULL
    ,last_name VARCHAR(255) NOT NULL
    ,account_email VARCHAR(255) UNIQUE NOT NULL
    ,pass_hash VARCHAR(255) NOT NULL
);

CREATE TABLE video_links (
    video_id serial PRIMARY KEY
    ,link VARCHAR(1000)
    ,ranking smallint NOT NULL
    ,user_id integer NOT NULL
    ,CONSTRAINT video_links_user_id_fkey FOREIGN KEY (user_id)
        REFERENCES user_account (user_id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
);