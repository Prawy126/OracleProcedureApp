create or replace PACKAGE users_pkg IS
    TYPE doctor_rec IS RECORD (
        id              NUMBER,
        name            VARCHAR2(20),
        surname         VARCHAR2(25),
        specialization  VARCHAR2(50),
        license_number  VARCHAR2(50),
        user_id         NUMBER
    );

    TYPE patient_rec IS RECORD (
        id              NUMBER,
        name            VARCHAR2(20),
        surname         VARCHAR2(25),
        nurse_id        NUMBER,
        user_id         NUMBER,
        time_visit      NUMBER,
        room_id         NUMBER
    );

    TYPE nurse_rec IS RECORD (
        id              NUMBER,
        name            VARCHAR2(20),
        surname         VARCHAR2(30),
        NUMBER_LICENSE  VARCHAR2(30),
        user_id         NUMBER
    );

    PROCEDURE add_doctor(p_doctor IN doctor_rec);
    PROCEDURE get_doctor(p_doctor_id IN NUMBER, p_doctor OUT SYS_REFCURSOR);
    PROCEDURE update_doctor(p_doctor IN doctor_rec);
    PROCEDURE delete_doctor(p_doctor_id IN NUMBER);

    PROCEDURE add_patient(p_patient IN patient_rec);
    PROCEDURE get_patient(p_patient_id IN NUMBER, p_patient OUT SYS_REFCURSOR);
    PROCEDURE update_patient(p_patient IN patient_rec);
    PROCEDURE delete_patient(p_patient_id IN NUMBER);

    PROCEDURE add_nurse(p_nurse IN nurse_rec);
    PROCEDURE get_nurse(p_nurse_id IN NUMBER, p_nurse OUT SYS_REFCURSOR);
    PROCEDURE update_nurse(p_nurse IN nurse_rec);
    PROCEDURE delete_nurse(p_nurse_id IN NUMBER);

END users_pkg;

create or replace PACKAGE BODY users_pkg IS

    PROCEDURE add_doctor(p_doctor IN doctor_rec) IS
    BEGIN
        INSERT INTO doctors (name, surname, specialization, license_number, user_id)
        VALUES (p_doctor.name, p_doctor.surname, p_doctor.specialization, p_doctor.license_number, p_doctor.user_id);
    END add_doctor;

    PROCEDURE get_doctor(p_doctor_id IN NUMBER, p_doctor OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_doctor FOR
        SELECT * FROM doctors WHERE id = p_doctor_id;
    END get_doctor;

    PROCEDURE update_doctor(p_doctor IN doctor_rec) IS
    BEGIN
        UPDATE doctors
        SET name = p_doctor.name,
            surname = p_doctor.surname,
            specialization = p_doctor.specialization,
            license_number = p_doctor.license_number,
            user_id = p_doctor.user_id
        WHERE id = p_doctor.id;
    END update_doctor;

        -- Delete a doctor
    -- Delete a doctor
    PROCEDURE delete_doctor(p_doctor_id IN NUMBER) IS
    BEGIN
        BEGIN
            DELETE FROM doctors WHERE id = p_doctor_id;
        EXCEPTION
            WHEN OTHERS THEN
                IF SQLCODE = -2292 THEN
                    RAISE_APPLICATION_ERROR(-20001, 'Nie można usunąć lekarza, który jest już przypisany.');
                ELSE
                    RAISE;
                END IF;
        END;
    END delete_doctor;
    PROCEDURE add_patient(p_patient IN patient_rec) IS
    BEGIN
        INSERT INTO patients (name, surname, nurse_id, user_id, time_visit, room_id)
        VALUES (p_patient.name, p_patient.surname, p_patient.nurse_id, p_patient.user_id, p_patient.time_visit, p_patient.room_id);
    END add_patient;

    PROCEDURE get_patient(p_patient_id IN NUMBER, p_patient OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_patient FOR
        SELECT * FROM patients WHERE id = p_patient_id;
    END get_patient;

    PROCEDURE update_patient(p_patient IN patient_rec) IS
    BEGIN
        UPDATE patients
        SET name = p_patient.name,
            surname = p_patient.surname,
            nurse_id = p_patient.nurse_id,
            user_id = p_patient.user_id,
            time_visit = p_patient.time_visit,
            room_id = p_patient.room_id
        WHERE id = p_patient.id;
    END update_patient;

    PROCEDURE delete_patient(p_patient_id IN NUMBER) IS
    BEGIN
        DELETE FROM patients WHERE id = p_patient_id;
    END delete_patient;

    PROCEDURE add_nurse(p_nurse IN nurse_rec) IS
    BEGIN
        INSERT INTO nurses (name, surname, NUMBER_LICENSE, user_id)
        VALUES (p_nurse.name, p_nurse.surname, p_nurse.NUMBER_LICENSE, p_nurse.user_id);
    END add_nurse;

    PROCEDURE get_nurse(p_nurse_id IN NUMBER, p_nurse OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_nurse FOR
        SELECT * FROM nurses WHERE id = p_nurse_id;
    END get_nurse;

    PROCEDURE update_nurse(p_nurse IN nurse_rec) IS
    BEGIN
        UPDATE nurses
        SET name = p_nurse.name,
            surname = p_nurse.surname,
            NUMBER_LICENSE = p_nurse.NUMBER_LICENSE,
            user_id = p_nurse.user_id
        WHERE id = p_nurse.id;
    END update_nurse;

 -- Delete a nurse
    PROCEDURE delete_nurse(p_nurse_id IN NUMBER) IS
        v_count NUMBER;
    BEGIN
        -- Check if the nurse is assigned to any patient or procedure
        SELECT COUNT(*) INTO v_count FROM patients WHERE nurse_id = p_nurse_id;
        IF v_count > 0 THEN
            RAISE_APPLICATION_ERROR(-20001, 'Cannot delete nurse: Nurse is assigned to one or more patients.');
        END IF;

        -- You can add more checks here for other assignments...

        DELETE FROM nurses WHERE id = p_nurse_id;
    END delete_nurse;


END users_pkg;