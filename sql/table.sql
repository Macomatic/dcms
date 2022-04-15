CREATE TABLE "User"(
    user_ID INTEGER,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL,
    role VARCHAR(20),
    PRIMARY KEY (user_ID)
);

CREATE TABLE Patient (
    patient_ID INTEGER,
	PRIMARY KEY (patient_ID),
    name VARCHAR(50),
    gender VARCHAR(20),
    insurance VARCHAR(20),
    ssn INTEGER,
    email VARCHAR(50),
    dateOfBirth DATE,
    address VARCHAR(50),
    phoneNumber VARCHAR(10),  
	FOREIGN KEY (patient_ID)  REFERENCES "User"(user_ID)
);

CREATE TABLE Branch(
    branch_ID INTEGER,
    address VARCHAR(50),
    professionalismScore INTEGER,
    cleanlinessScore INTEGER,
    communicationScore INTEGER,
    PRIMARY KEY (branch_ID)
);

CREATE TABLE Employee(
    employee_ID INTEGER REFERENCES "User"(user_ID),
	PRIMARY KEY (employee_ID),
    name VARCHAR(50),
    address VARCHAR(50),
    role VARCHAR(20),
    employmentType VARCHAR(20),
    ssn INTEGER,
    salary INTEGER,
    branch_ID INTEGER REFERENCES Branch(branch_ID),
	FOREIGN KEY (employee_ID) REFERENCES "User"(user_ID),
	FOREIGN KEY (branch_ID) REFERENCES Branch(branch_ID)
);

CREATE TABLE BranchManager(
	bManager_ID INTEGER REFERENCES "User"(user_ID),
    PRIMARY KEY (bManager_ID)
	branch_ID INTEGER REFERENCES Branch(branch_ID),
	name VARCHAR(50),
	FOREIGN KEY (bManager_ID) REFERENCES "User"(user_ID),
	FOREIGN KEY (branch_ID) REFERENCES Branch(branch_ID)
);

CREATE TABLE Appointment(
    appointment_ID INTEGER,
	treatment_ID INTEGER,
    patient_ID INTEGER,
    dentist_ID INTEGER,
    date DATE,
    startTime VARCHAR(20),
    endTime VARCHAR(20),
    appointmentType VARCHAR(20),
    status VARCHAR(20),
    room VARCHAR(20),
    PRIMARY KEY (appointment_ID),
    FOREIGN KEY (patient_ID) REFERENCES Patient(patient_ID),
    FOREIGN KEY (dentist_ID) REFERENCES Employee(employee_ID)
);

CREATE TABLE AppointmentProcedure(
    patient_ID INTEGER,
    date DATE,
    procedureCode INTEGER,
    procedureType VARCHAR(20),
    description VARCHAR(100),
    involvedTooth VARCHAR(20),
    procedureAmount INTEGER,
    PRIMARY KEY (patient_ID, date, procedureCode),
    FOREIGN KEY (patient_ID) REFERENCES Patient(patient_ID)
);

CREATE TABLE Treatment(
	treatment_ID INTEGER,
    patientCondition VARCHAR(20),
    treatmentType VARCHAR(20),
    medication VARCHAR(50),
    treatmentType_ID INTEGER,
    PRIMARY KEY (treatment_ID)
);

CREATE TABLE TreatmentSymptoms(
    treatment_ID INTEGER,
    symptom VARCHAR(50),
    FOREIGN KEY (treatment_ID) REFERENCES Treatment(treatment_ID)

);


CREATE TABLE Invoice(
    dateOfIssue DATE,
    contactInfo VARCHAR(50),
    patientInsurance VARCHAR(50),
    amount INTEGER
);

CREATE TABLE Reviews(
    review_ID INTEGER,
    patient_ID INTEGER,
    branch_ID INTEGER,
    professionalism VARCHAR(100),
    communication VARCHAR(100),
    cleanliness VARCHAR(100),
    value INTEGER,
    PRIMARY KEY (review_ID),
    FOREIGN KEY (patient_ID) REFERENCES Patient(patient_ID),
    FOREIGN KEY (branch_ID) REFERENCES Branch(branch_ID)
);
INSERT INTO "User"(
	user_id, username, password, role)
	VALUES (123456, 'John123', 'randompassword', 'branchmanager');
INSERT INTO "User"(
	user_id, username, password, role)
	VALUES (123457, 'Sam456', 'randomchars', 'employee');
INSERT INTO "User"(
	user_id, username, password, role)
	VALUES (123458, 'Alexa789', 'randomnums', 'patient');
INSERT INTO patient(
	patient_id, name, gender, insurance, ssn, email, dateofbirth, address, phonenumber)
	VALUES (123458, 'Alexa M.', 'female', 'SunLife', 123123123, 'alexa@yahoo.ca', '1999-09-13', '123 Fake St.', '1231234567');
INSERT INTO branch(
	branch_id, address, professionalismscore, cleanlinessscore, communicationscore)
	VALUES (12, '12 Branch st.', 5, 5, 5);
INSERT INTO employee(
	employee_id, name, address, role, employmenttype, ssn, salary, branch_id)
	VALUES (123457, 'Sam W.', '12 Employee St.', 'Dentist', 'Full-Time', 241543234, 90000, 12);
INSERT INTO branchmanager(
	bmanager_id, branch_id, name)
	VALUES (123456, 12, 'John Doe');
INSERT INTO appointment(
	appointment_id, treatment_id, patient_id, dentist_id, date, starttime, endtime, appointmenttype, status, room)
	VALUES (1,1,123458,123457,'2022-04-21','9:00','10:00','cleaning', 'healthy', '314');
INSERT INTO appointmentprocedure(
	patient_id, date, procedurecode, proceduretype, description, involvedtooth, procedureamount)
	VALUES (123458, '2022-04-19', 313, 'cleaning', 'semi-annual general check up', 'all', 300);
INSERT INTO treatment(
	treatment_id, patientcondition, treatmenttype, medication, treatmenttype_id)
	VALUES (1, 'healthy', 'check-up advice','no medication supplied with cleaning amenities', 1);
INSERT INTO treatmentsymptoms(
	treatment_id, symptom)
	VALUES (1, 'no symptoms from treatment');
INSERT INTO invoice(
	dateofissue, contactinfo, patientinsurance, amount)
	VALUES ('2022-04-23', 'branch12dentist@gmail.com', 'SunLife, checkup is covered semi-annually', 0);
INSERT INTO reviews(
	review_id, patient_id, branch_id, professionalism, communication, cleanliness, value)
	VALUES (1, 123458, 12, 'well experienced and knowledgeable', 'concise and clear', 'spotless, no dust or dirt', 5);