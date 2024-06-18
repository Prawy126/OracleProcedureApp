create or replace PROCEDURE ADD_PATIENT(
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_nurse_id IN NUMBER,
    p_user_id IN NUMBER,
    p_time_visit IN NUMBER,
    p_room_id IN NUMBER)
IS
BEGIN
    INSERT INTO patients (name, surname, nurse_id, user_id, time_visit, room_id)
    VALUES (p_name, p_surname, p_nurse_id, p_user_id, p_time_visit, p_room_id);
END;
/
create or replace PROCEDURE DELETE_PATIENT(
    p_patient_id IN NUMBER)
IS
BEGIN
    DELETE FROM patients WHERE id = p_patient_id;
END;
/
create or replace PROCEDURE GET_PATIENT(
    p_patient_id IN NUMBER,
    p_patient OUT SYS_REFCURSOR)
IS
BEGIN
    OPEN p_patient FOR
    SELECT * FROM patients WHERE id = p_patient_id;
END;
/
create or replace PROCEDURE UPDATE_PATIENT(
    p_patient_id IN NUMBER,
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_nurse_id IN NUMBER,
    p_user_id IN NUMBER,
    p_time_visit IN NUMBER,
    p_room_id IN NUMBER)
IS
BEGIN
    UPDATE patients
    SET name = p_name,
        surname = p_surname,
        nurse_id = p_nurse_id,
        user_id = p_user_id,
        time_visit = p_time_visit
    WHERE id = p_patient_id;
END;
/