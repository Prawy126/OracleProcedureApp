create or replace PROCEDURE ADD_DOCTOR (
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_specialization IN VARCHAR2,
    p_license_number IN VARCHAR2,
    p_user_id IN NUMBER
)
IS
BEGIN
    INSERT INTO doctors (name, surname, specialization, license_number, user_id)
    VALUES (p_name, p_surname, p_specialization, p_license_number, p_user_id);
END ADD_DOCTOR;

create or replace PROCEDURE GET_DOCTOR(
    p_doctor_id IN NUMBER,
    p_doctor OUT SYS_REFCURSOR)
IS
BEGIN
    OPEN p_doctor FOR
    SELECT * FROM doctors WHERE id = p_doctor_id;
END;

create or replace PROCEDURE UPDATE_DOCTOR(
    p_doctor_id IN NUMBER,
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_specialization IN VARCHAR2,
    p_license_number IN VARCHAR2,
    p_user_id IN NUMBER)
IS
BEGIN
    UPDATE doctors
    SET name = p_name,
        surname = p_surname,
        specialization = p_specialization,
        license_number = p_license_number,
        user_id = p_user_id
    WHERE id = p_doctor_id;
END;

create or replace PROCEDURE DELETE_DOCTOR(
    p_doctor_id IN NUMBER)
IS
BEGIN
    DELETE FROM doctors WHERE id = p_doctor_id;
END;