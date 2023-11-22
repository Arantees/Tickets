CREATE TABLE public.users(
	id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,	
    email VARCHAR (255) NOT NULL UNIQUE,    
	password VARCHAR(255) NOT NULL,
    birthday DATE,
	created_at TIMESTAMP default now(),
	roles VARCHAR(255),
	update_at TIMESTAMP default now()
);

CREATE TABLE public.boards(
	users_id INT REFERENCES public.users(id),
	title VARCHAR(50) NOT NULL,
	id SERIAL PRIMARY KEY,
	description TEXT NOT NULL,
	created_at TIMESTAMP default now(),
	update_at TIMESTAMP default now(),
	priority INT
);


CREATE TABLE public.cards(
	boards_id INT REFERENCES public.boards(id),
	title VARCHAR(50) NOT NULL,
	id SERIAL PRIMARY KEY,
	description TEXT NOT NULL,
	created_at TIMESTAMP default now(),
	update_at TIMESTAMP default now(),
	priority INT,
	expiration_date DATE
);

CREATE TABLE public.lists(
	title VARCHAR(50) NOT NULL,
	cards_id INT REFERENCES public.cards(id),
	id SERIAL PRIMARY KEY,
	description TEXT NOT NULL,
	created_at TIMESTAMP default now(),
	update_at TIMESTAMP default now()
);
