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
    totalReviews INTEGER,
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