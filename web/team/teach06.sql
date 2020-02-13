CREATE TABLE topic (
    id serial PRIMARY KEY
    ,name VARCHAR(255) NOT NULL
);

INSERT INTO topic (
    name
)
VALUES (
    'Faith'
),
(
    'Sacrifice'
),
(
    'Charity'
);

CREATE TABLE scripture_topics (
    id serial PRIMARY KEY
    , scripture_id integer NOT NULL
    , topic_id integer NOT NULL
    , CONSTRAINT scripture_topics_scripture_id_fkey FOREIGN KEY (scripture_id)
        REFERENCES scriptures (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
    , CONSTRAINT scripture_topics_topic_id_fkey FOREIGN KEY (topic_id)
        REFERENCES topic (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
);