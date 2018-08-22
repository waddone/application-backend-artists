# Codebase backend applicants

In order to judge your developer skills we would like you to do the following task.
The task should not exceed two hours of working time. After that time simply stop working
on the task.

Finished or unfinished we would like to see your result and a couple of words
of feedback from your end in order to get a better understanding of your thought process.

Send your feedback by creating a pull-request from your repository to the original one:
https://github.com/gimmenetwork/application-backend-artists

## Requirements

- PHP 7.1.3+
- MySQL
- Github account
- Git skills
- Symfony 4 skills
- Composer skills

## Installation

- Fork this repository
- Clone your forked repository so that you can work on it 
- Install the composer packages

Now you should be able to run `bin/console server:run` to start up your development server.

## Your task

It is your decision on how you want to build this app. Use only the included composer packages
and fulfill the following requirements:

1. As a user I wanna be able to browse through all artists, their albums and songs
    * Build a database based on the following dataset:
        * https://gist.github.com/fightbulc/58a0f479299c4e07b4f792b58e9067af
        * Ensure that all entities have a reference we can expose publically
            * never expose the actual database id
    * Import the dataset in form of a fixture
    * The visual design is up to you
2. As a developer I wanna be able to have access to two API endpoints:
    * `GET /artists`
        * return a collection of artists with their albums
        * for albums expose only their reference, name and cover
        * support direct request of artist data `GET /artists/[reference]`
    * `GET /albums`
        * return a collection of albums with their artist reference
        * show only reference, name and cover
        * support direct request of album data `GET /albums/[reference]`
            * show all available information for an album
    * All responses should be JSON encoded        
