#members
INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
"Archie",
"Andrews",
'Male',
"5000000",
"aa@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
"Billy",
"Batson",
'Male',
"5500000",
"bb@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Clark',
'Kent',
'Male',
"5550000",
"ck@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Doug',
'Dimmadome',
'Male',
"5555000",
"dd@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Peter',
'Parker',
'Male',
"5555500",
"pp@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Spongebob',
'Squarepants',
'Male',
"5555550",
"UnderTheSea@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Jean',
'Grey',
'Female',
"5555550",
"phoenix@email",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Bruce',
'Wayne',
'Male',
"5055550",
"bruce@wayneindusties.com",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Jennifer',
'Walters',
'Female',
"5050550",
"jWalters@GLKH.com",
'INDIVIDUAL');

INSERT INTO `afga`.`member`
(`MemNo`,
`FName`,
`LName`,
`Gender`,
`Phone`,
`Email`,
`Type`)
VALUES
("0",
'Diana',
'Themiscyra',
'Female',
"5055550",
"Themiscyra@UN.org",
'INDIVIDUAL');

#Animals
INSERT INTO `afga`.`animal`
(`TagNo`,
`Weight`,
`Species`,
`Gender`,
`Type`,
`Hunter`,
`WeaponUsed`)
VALUES
('1001',
'150',
'deer',
'Male',
'Mammal',
'5',
'');

INSERT INTO `afga`.`animal`
(`TagNo`,
`Weight`,
`Species`,
`Gender`,
`Type`,
`Hunter`,
`WeaponUsed`)
VALUES
('5002',
'500',
'bear',
'Male',
'Mammal',
'8',
'');

INSERT INTO `afga`.`animal`
(`TagNo`,
`Weight`,
`Species`,
`Gender`,
`Type`,
`Hunter`,
`WeaponUsed`)
VALUES
('9003',
'50',
'duck',
'female',
'Bird',
'2',
'');

INSERT INTO `afga`.`animal`
(`TagNo`,
`Weight`,
`Species`,
`Gender`,
`Type`,
`Hunter`,
`WeaponUsed`)
VALUES
('1004',
'100',
'deer',
'female',
'Mammal',
'5',
'');

INSERT INTO `afga`.`animal`
(`TagNo`,
`Weight`,
`Species`,
`Gender`,
`Type`,
`Hunter`,
`WeaponUsed`)
VALUES
('7005',
'20',
'Trout',
'Female',
'Fish',
'1',
'');
#Club
INSERT INTO `afga`.`club`
(`City`,
`Address`,
`NumMemb`)
VALUES
('Calgary',
'',
'4');

INSERT INTO `afga`.`club`
(`City`,
`Address`,
`NumMemb`)
VALUES
('Toronto',
'',
'4');



INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('1',
'calgary');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('2',
'calgary');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('3',
'calgary');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('4',
'calgary');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('5',
'Toronto');
INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('6',
'Toronto');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('7',
'Toronto');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('8',
'Toronto');

INSERT INTO `afga`.`membercard`
(`MemNo`,
`Club`)
VALUES
('9',
'Toronto');

#firing range
INSERT INTO `afga`.`firingrange`
(`Latitude`,
`Longitude`,
`Club`)
VALUES
(100,
100,
'Calgary');

INSERT INTO `afga`.`firingrange`
(`Latitude`,
`Longitude`,
`Club`)
VALUES
('200',
'200',
'Toronto');

#event
INSERT INTO `afga`.`event`
(`Name`,
`Date`,
`City`,
`Street`,
`Club`)
VALUES
("Hardy Hunting",
'2019-04-30',
'Calgary',
'centre st',
'Calgary');

INSERT INTO `afga`.`event`
(`Name`,
`Date`,
`City`,
`Street`,
`Club`)
VALUES
('Freds fishing',
'2019-04-30',
'Banff',
'centre st',
'Calgary');

INSERT INTO `afga`.`event`
(`Name`,
`Date`,
`City`,
`Street`,
`Club`)
VALUES
('Taylor Trapping',
'2019-04-30',
'london',
'centre st',
'Toronto');

INSERT INTO `afga`.`event`
(`Name`,
`Date`,
`City`,
`Street`,
`Club`)
VALUES
('Call of the Wild',
'2019-04-20',
'london',
'centre st',
'Toronto');

INSERT INTO `afga`.`event`
(`Name`,
`Date`,
`City`,
`Street`,
`Club`)
VALUES
('Blaze it',
'2019-04-20',
'Calgary',
'deerfoot',
'Calgary');


INSERT INTO `afga`.`attends`
(`EventName`,
`EventDate`,
`MemNo`)
VALUES
('Freds fishing',
'2019-04-30',
'1');

INSERT INTO `afga`.`attends`
(`EventName`,
`EventDate`,
`MemNo`)
VALUES
('Taylor Trapping',
'2019-04-30',
'2');

INSERT INTO `afga`.`attends`
(`EventName`,
`EventDate`,
`MemNo`)
VALUES
('Taylor Trapping',
'2019-04-30',
'3');

#dependson
INSERT INTO `afga`.`dependson`
(`HeadNo`,
`SpouseNo`,
`DependentNo`)
VALUES
('7',
'10',
'1');

#practiceat
INSERT INTO `afga`.`practiceat`
(`Latitude`,
`Longitude`,
`MemNo`)
VALUES
('200',
'200',
'2');

INSERT INTO `afga`.`practiceat`
(`Latitude`,
`Longitude`,
`MemNo`)
VALUES
('200',
'200',
'4');

INSERT INTO `afga`.`practiceat`
(`Latitude`,
`Longitude`,
`MemNo`)
VALUES
('100',
'100',
'1');

INSERT INTO `afga`.`practiceat`
(`Latitude`,
`Longitude`,
`MemNo`)
VALUES
('100',
'100',
'3');

INSERT INTO `afga`.`practiceat`
(`Latitude`,
`Longitude`,
`MemNo`)
VALUES
('100',
'100',
'5');

#incident
INSERT INTO `afga`.`incident`
(`IncidentNum`,
`Date`,
`ReporterName`,
`EmergencyFlag`,
`ViolationFlag`,
`OtherFlag`,
`Club`)
VALUES
('101',
'2019-04-03',
'Grayson',
'1',
'0',
'0',
'Calgary');

INSERT INTO `afga`.`incident`
(`IncidentNum`,
`Date`,
`ReporterName`,
`EmergencyFlag`,
`ViolationFlag`,
`OtherFlag`,
`Club`)
VALUES
('102',
'2019-04-02',
'Grayson',
'0',
'1',
'0',
'Calgary');

INSERT INTO `afga`.`incident`
(`IncidentNum`,
`Date`,
`ReporterName`,
`EmergencyFlag`,
`ViolationFlag`,
`OtherFlag`,
`Club`)
VALUES
('103',
'2019-04-03',
'Grayson',
'0',
'0',
'1',
'Toronto');

#Prizes
INSERT INTO `afga`.`prize`
(`PrizeName`,
`Member`,
`EventName`,
`EventDate`,
`Animal`)
VALUES
('Rodolf',
'5',
'Hardy Hunting',
'2019-04-30',
'1001');

INSERT INTO `afga`.`prize`
(`PrizeName`,
`Member`,
`EventName`,
`EventDate`,
`Animal`)
VALUES
('white-tailed',
'5',
'Hardy Hunting',
'2019-04-30',
'1004');

INSERT INTO `afga`.`prize`
(`PrizeName`,
`Member`,
`EventName`,
`EventDate`,
`Animal`)
VALUES
('Big Skipper',
'1',
'Freds fishing',
'2019-04-30',
'7005');

INSERT INTO `afga`.`prize`
(`PrizeName`,
`Member`,
`EventName`,
`EventDate`,
`Animal`)
VALUES
('Serpentine',
'2',
'Freds fishing',
'2019-04-30',
'9003');

INSERT INTO `afga`.`prize`
(`PrizeName`,
`Member`,
`EventName`,
`EventDate`,
`Animal`)
VALUES
('Ursa',
'8',
'Taylor Trapping',
'2019-04-30',
'5002');

INSERT INTO `afga`.`login`
(`MemberID`,
`username`,
`password`,
`role`)
VALUES
('1',
'adminTest',
'pw',
'admin');

INSERT INTO `afga`.`login`
(`MemberID`,
`username`,
`password`,
`role`)
VALUES
('2',
'memberTest',
'pw',
'member');

INSERT INTO `afga`.`login`
(`MemberID`,
`username`,
`password`,
`role`)
VALUES
('7',
'member2',
'pw',
'member');

INSERT INTO `afga`.`newsletter`
(`IssueNo`,
`NumOfSubs`)
VALUES
('1',
'45');

INSERT INTO `afga`.`newsletter`
(`IssueNo`,
`NumOfSubs`)
VALUES
('2',
'1000');

INSERT INTO `afga`.`newsletter`
(`IssueNo`,
`NumOfSubs`)
VALUES
('20',
'40');

INSERT INTO `afga`.`SubscribesTo`
(`MemNo`,
`IssueNo`)
VALUES
('7',
'20');

INSERT INTO `afga`.`SubscribesTo`
(`MemNo`,
`IssueNo`)
VALUES
('7',
'1');

INSERT INTO `afga`.`SubscribesTo`
(`MemNo`,
`IssueNo`)
VALUES
('2',
'20');



