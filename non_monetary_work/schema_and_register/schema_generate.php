<?php
$server="localhost";
$user="root";
$password="";
$db="swift_bank";
$conn=new mysqli($server,$user,$password,$db);

if($conn->connect_error)
{
    die("connection failed");
}
$sql="CREATE table admin(
	username varchar(30) primary key,
    password varchar(30)
);
create table user(
	user_id numeric(10) primary key,
    password varchar(15) not null,
    pin int(4) not null
);
create table problem(
	email varchar(50) not null,
    problem blob not null,
    user_id numeric(10),
    foreign key(user_id) references user(user_id)
);
create table account_holder(
	first_name varchar(15) not null,
    last_name varchar(15) not null,
    registered_email varchar(50) not null,
    citizenship_no numeric(10) primary key,
    address varchar(30) not null,
    date_of_birth date not null,
    user_id numeric(10),
    foreign key(user_id) references user(user_id)
);
create table account(
	acc_no numeric(15) primary key,
    balance numeric not null ,check (balance>1000),
    date_created date not null,
    citizenship_no numeric(10),
    user_id numeric(10),
    foreign key(user_id) references user(user_id),
    foreign key (citizenship_no) references account_holder(citizenship_no)
);
create table loan(
	loan_id numeric primary key,
    amount_due numeric,check(amount_due<=25000),
    interest numeric,
    status varchar(15),
    user_id numeric(10),
    acc_no numeric(15),
    foreign key(user_id) references user(user_id),
    foreign key (acc_no)references account(acc_no)
);
create table transaction(
    date_of_transaction date,
    amount numeric,
    receiver_id numeric(10),
    receiver_acc_no numeric(15),
    transaction_type varchar(15),
    user_id numeric(15),
    foreign key (user_id) references user(user_id),
    foreign key (receiver_id) references user(user_id),
    foreign key (receiver_acc_no) references account(acc_no)
);";
$sql2="INSERT into account_holder values('pranav','sthapit','pranavsthapit17@gmail.com',1111,'ktm','2000-1-1',null);
insert into account values(12345,2000,'2020-1-1',1111,null);";
if($conn->multi_query($sql2))
{
    echo "done insert creation";
}
?>