<?php

/* @var $this yii\web\View */

$this->title = 'Assignment 3';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Greetings!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>Create database</label>
                    </div>
                    <div class="panel-body"><p>Create a database called users using this sql command
                            <code>CREATE DATABASE `users`</code>
                        </p></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>Create table(s)</label>
                    </div>
                    <div class="panel-body"><p>Create a table called login using this sql command
                            <code>CREATE TABLE `login` (
                                `id` int(10) NOT NULL AUTO_INCREMENT,
                                `username` varchar(128) NOT NULL,
                                `password` varchar(128) NOT NULL,
                                `authKey` varchar(128) NOT NULL,
                                `accessToken` varchar(128) NOT NULL,
                                PRIMARY KEY (`id`)
                                );</code></p></div>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <label>Create users</label>
                    </div>
                    <div class="panel-body"><p>Add users to the table</p></div>
                </div>
            </div>

        </div>
    </div>
</div>
