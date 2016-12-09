USE mainDB;

DROP TABLE admissions;

DROP TABLE discharges;


CREATE TABLE admissions(
siteName VARCHAR(30),
adDate DATETIME,
ageGroup INT,
gender VARCHAR(1),
reason INT
);

CREATE TABLE discharges(
siteName VARCHAR(30),
disDate DATETIME,
ageGroup INT,
gender VARCHAR(1),
reason INT
);
