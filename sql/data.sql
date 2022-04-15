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