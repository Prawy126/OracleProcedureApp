-- Pakiet users_pkg
CREATE OR REPLACE PACKAGE users_pkg IS
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
/

CREATE OR REPLACE PACKAGE BODY users_pkg IS

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

    PROCEDURE delete_doctor(p_doctor_id IN NUMBER) IS
    BEGIN
        DELETE FROM doctors WHERE id = p_doctor_id;
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

    PROCEDURE delete_nurse(p_nurse_id IN NUMBER) IS
    BEGIN
        DELETE FROM nurses WHERE id = p_nurse_id;
    END delete_nurse;

END users_pkg;
/

-- Pakiet szpital
CREATE OR REPLACE PACKAGE szpital AS
    TYPE medicin_rec IS RECORD (
        id NUMBER,
        name VARCHAR2(200),
        instruction CLOB,
        warehouse_quantity NUMBER,
        drug_category VARCHAR2(200),
        drug_form VARCHAR2(200),
        price NUMBER,
        dose_unit VARCHAR2(200)
    );

    TYPE room_rec IS RECORD (
        id NUMBER,
        rnumber VARCHAR2(200),
        rlocation VARCHAR2(200),
        status VARCHAR2(200),
        type_room VARCHAR2(200),
        seats NUMBER
    );

    TYPE treatment_type_rec IS RECORD (
        id NUMBER,
        name VARCHAR2(200),
        description CLOB,
        recommendations_before_surgery CLOB,
        recommendations_after_surgery CLOB,
        created_at TIMESTAMP,
        updated_at TIMESTAMP
    );

    PROCEDURE add_medicine(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    );

    PROCEDURE get_medicin(
        p_medicin_id IN NUMBER,
        p_medicin OUT SYS_REFCURSOR
    );

    PROCEDURE update_medicin(
        p_medicin_id IN NUMBER,
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    );

    PROCEDURE delete_medicin(
        p_medicin_id IN NUMBER
    );

    PROCEDURE add_room(
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN INTEGER
    );

    PROCEDURE get_room(
        p_room_id IN NUMBER,
        p_room OUT SYS_REFCURSOR
    );

    PROCEDURE update_room(
        p_room_id IN NUMBER,
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN NUMBER
    );

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    );

    PROCEDURE add_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_CREATED_AT IN TIMESTAMP
    );

    PROCEDURE get_treatment_type(
        p_ID IN NUMBER,
        p_NAME OUT VARCHAR2,
        p_DESCRIPTION OUT CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY OUT CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY OUT CLOB,
        p_CREATED_AT OUT TIMESTAMP,
        p_UPDATED_AT OUT TIMESTAMP
    );

    PROCEDURE update_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_UPDATED_AT IN TIMESTAMP
    );

    PROCEDURE delete_treatment_type(
        p_ID IN NUMBER
    );
END szpital;
/

CREATE OR REPLACE PACKAGE BODY szpital AS

    PROCEDURE add_medicine(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        INSERT INTO MEDICINS ("NAME", "INSTRUCTION", "WAREHOUSE_QUANTITY", "DRUG_CATEGORY", "DRUG_FORM", "PRICE", "DOSE_UNIT")
        VALUES (p_name, p_instruction, p_warehouse_quantity, p_drug_category, p_price, p_drug_form, p_dose_unit);
    END add_medicine;

    PROCEDURE get_medicin(
        p_medicin_id IN NUMBER,
        p_medicin OUT SYS_REFCURSOR
    ) IS
    BEGIN
        OPEN p_medicin FOR
        SELECT * FROM medicins WHERE id = p_medicin_id;
    END get_medicin;

    PROCEDURE update_medicin(
        p_medicin_id IN NUMBER,
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_drug_form IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        UPDATE medicins
        SET name = p_name,
            instruction = p_instruction,
            warehouse_quantity = p_warehouse_quantity,
            drug_category = p_drug_category,
            drug_form = p_drug_form,
            price = p_price,
            dose_unit = p_dose_unit
        WHERE id = p_medicin_id;
    END update_medicin;

    PROCEDURE delete_medicin(
        p_medicin_id IN NUMBER
    ) IS
    BEGIN
        DELETE FROM medicins WHERE id = p_medicin_id;
    END delete_medicin;

    PROCEDURE add_room(
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN INTEGER
    ) IS
    BEGIN
        INSERT INTO rooms (rnumber, rlocation, status, type_room, seats)
        VALUES (p_rnumber, p_rlocation, p_status, p_type_room, p_seats);
    END add_room;

    PROCEDURE get_room(
        p_room_id IN NUMBER,
        p_room OUT SYS_REFCURSOR
    ) IS
    BEGIN
        OPEN p_room FOR
        SELECT * FROM rooms WHERE id = p_room_id;
    END get_room;

    PROCEDURE update_room(
        p_room_id IN NUMBER,
        p_rnumber IN VARCHAR2,
        p_rlocation IN VARCHAR2,
        p_status IN VARCHAR2,
        p_type_room IN VARCHAR2,
        p_seats IN NUMBER
    ) IS
    BEGIN
        UPDATE rooms
        SET rnumber = p_rnumber,
            rlocation = p_rlocation,
            status = p_status,
            type_room = p_type_room,
            seats = p_seats
        WHERE id = p_room_id;
    END update_room;

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    ) IS
    BEGIN
        DELETE FROM rooms WHERE id = p_room_id;
    END delete_room;

    PROCEDURE add_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_CREATED_AT IN TIMESTAMP
    ) IS
    BEGIN
        INSERT INTO TREATMENT_TYPES ("ID", "NAME", "DESCRIPTION", RECOMMENDATIONS_BEFORE_SURGERY, RECOMMENDATIONS_AFTER_SURGERY, CREATED_AT)
        VALUES (p_ID, p_NAME, p_DESCRIPTION, p_RECOMMENDATIONS_BEFORE_SURGERY, p_RECOMMENDATIONS_AFTER_SURGERY, p_CREATED_AT);
    END add_treatment_type;

    PROCEDURE get_treatment_type(
        p_ID IN NUMBER,
        p_NAME OUT VARCHAR2,
        p_DESCRIPTION OUT CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY OUT CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY OUT CLOB,
        p_CREATED_AT OUT TIMESTAMP,
        p_UPDATED_AT OUT TIMESTAMP
    ) IS
    BEGIN
        SELECT NAME, DESCRIPTION, RECOMMENDATIONS_BEFORE_SURGERY, RECOMMENDATIONS_AFTER_SURGERY, CREATED_AT, UPDATED_AT
        INTO p_NAME, p_DESCRIPTION, p_RECOMMENDATIONS_BEFORE_SURGERY, p_RECOMMENDATIONS_AFTER_SURGERY, p_CREATED_AT, p_UPDATED_AT
        FROM TREATMENT_TYPES
        WHERE ID = p_ID;
    END get_treatment_type;

    PROCEDURE update_treatment_type(
        p_ID IN NUMBER,
        p_NAME IN VARCHAR2,
        p_DESCRIPTION IN CLOB,
        p_RECOMMENDATIONS_BEFORE_SURGERY IN CLOB,
        p_RECOMMENDATIONS_AFTER_SURGERY IN CLOB,
        p_UPDATED_AT IN TIMESTAMP
    ) IS
    BEGIN
        UPDATE TREATMENT_TYPES
        SET NAME = p_NAME, DESCRIPTION = p_DESCRIPTION, RECOMMENDATIONS_BEFORE_SURGERY = p_RECOMMENDATIONS_BEFORE_SURGERY,
            RECOMMENDATIONS_AFTER_SURGERY = p_RECOMMENDATIONS_AFTER_SURGERY, UPDATED_AT = p_UPDATED_AT
        WHERE ID = p_ID;
    END update_treatment_type;

    PROCEDURE delete_treatment_type(
        p_ID IN NUMBER
    ) IS
    BEGIN
        DELETE FROM TREATMENT_TYPES WHERE ID = p_ID;
    END delete_treatment_type;

END szpital;
/

-- Sekwencje
CREATE SEQUENCE TREATMENTS_DOCTORS_USERS_ID_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE SEQUENCE STATUSES_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE SEQUENCE ASSIGNMENT_MEDICINES_ID_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE SEQUENCE TREATMENTS_NURSES_ID_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE SEQUENCE PROCEDURES_ID_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

-- Procedury CRUD dla innych tabel
CREATE OR REPLACE PROCEDURE ADD_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER
) AS
BEGIN
    INSERT INTO TREATMENTS_DOCTORS (ID, PROCEDURE_ID, DOCTOR_ID, CREATED_AT)
    VALUES (TREATMENTS_DOCTORS_USERS_ID_SEQ.NEXTVAL, p_PROCEDURE_ID, p_DOCTOR_ID, SYSTIMESTAMP);
END;

CREATE OR REPLACE PROCEDURE GET_TREATMENTS_DOCTORS (
    p_ID IN NUMBER,
    p_RESULT OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_RESULT FOR
    SELECT * FROM TREATMENTS_DOCTORS
    WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE UPDATE_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER
) AS
BEGIN
    UPDATE TREATMENTS_DOCTORS
    SET DOCTOR_ID = p_DOCTOR_ID
    WHERE PROCEDURE_ID = p_PROCEDURE_ID;
END;

CREATE OR REPLACE PROCEDURE DELETE_TREATMENTS_DOCTORS (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM TREATMENTS_DOCTORS WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE ADD_TREATMENTS_NURSES (
    p_NURSE_ID IN NUMBER,
    p_PROCEDURE_ID IN NUMBER
) AS
BEGIN
    INSERT INTO TREATMENTS_NURSES (NURSE_ID, PROCEDURE_ID)
    VALUES (p_NURSE_ID, p_PROCEDURE_ID);
END;

CREATE OR REPLACE PROCEDURE GET_TREATMENTS_NURSES (
    p_NURSE_ID IN NUMBER,
    p_PROCEDURE_ID OUT NUMBER
) AS
BEGIN
    SELECT PROCEDURE_ID
    INTO p_PROCEDURE_ID
    FROM TREATMENTS_NURSES
    WHERE NURSE_ID = p_NURSE_ID;
END;

CREATE OR REPLACE PROCEDURE UPDATE_TREATMENTS_NURSES (
    p_NURSE_ID IN NUMBER,
    p_PROCEDURE_ID IN NUMBER
) AS
BEGIN
    UPDATE TREATMENTS_NURSES
    SET PROCEDURE_ID = p_PROCEDURE_ID
    WHERE NURSE_ID = p_NURSE_ID;
END;

CREATE OR REPLACE PROCEDURE DELETE_TREATMENTS_NURSES (
    p_NURSE_ID IN NUMBER
) AS
BEGIN
    DELETE FROM TREATMENTS_NURSES WHERE NURSE_ID = p_NURSE_ID;
END;

CREATE OR REPLACE PROCEDURE ADD_ASSIGNMENT_MEDICINES (
    p_PATIENT_ID IN NUMBER,
    p_MEDICIN_ID IN NUMBER,
    p_DOSE IN NUMBER,
    p_DATE_START IN DATE,
    p_DATE_END IN DATE,
    p_EXPIRATION_DATE IN DATE,
    p_AVAILABILITY IN CHAR
) AS
BEGIN
    INSERT INTO ASSIGNMENT_MEDICINES (PATIENT_ID, MEDICIN_ID, DOSE, DATE_START, DATE_END, EXPIRATION_DATE, AVAILABILITY)
    VALUES (p_PATIENT_ID, p_MEDICIN_ID, p_DOSE, p_DATE_START, p_DATE_END, p_EXPIRATION_DATE, p_AVAILABILITY);
END;

CREATE OR REPLACE PROCEDURE GET_ASSIGNMENT_MEDICINES (
    p_PATIENT_ID IN NUMBER,
    p_MEDICIN_ID OUT NUMBER,
    p_DOSE OUT NUMBER,
    p_DATE_START OUT DATE,
    p_DATE_END OUT DATE,
    p_EXPIRATION_DATE OUT DATE,
    p_AVAILABILITY OUT CHAR
) AS
BEGIN
    SELECT MEDICIN_ID, DOSE, DATE_START, DATE_END, EXPIRATION_DATE, AVAILABILITY
    INTO p_MEDICIN_ID, p_DOSE, p_DATE_START, p_DATE_END, p_EXPIRATION_DATE, p_AVAILABILITY
    FROM ASSIGNMENT_MEDICINES
    WHERE PATIENT_ID = p_PATIENT_ID;
END;

CREATE OR REPLACE PROCEDURE UPDATE_ASSIGNMENT_MEDICINES (
    p_PATIENT_ID IN NUMBER,
    p_MEDICIN_ID IN NUMBER,
    p_DOSE IN NUMBER,
    p_DATE_START IN DATE,
    p_DATE_END IN DATE,
    p_EXPIRATION_DATE IN DATE,
    p_AVAILABILITY IN CHAR
) AS
BEGIN
    UPDATE ASSIGNMENT_MEDICINES
    SET MEDICIN_ID = p_MEDICIN_ID, DOSE = p_DOSE, DATE_START = p_DATE_START, DATE_END = p_DATE_END,
        EXPIRATION_DATE = p_EXPIRATION_DATE, AVAILABILITY = p_AVAILABILITY
    WHERE PATIENT_ID = p_PATIENT_ID;
END;

CREATE OR REPLACE PROCEDURE DELETE_ASSIGNMENT_MEDICINES (
    p_PATIENT_ID IN NUMBER
) AS
BEGIN
    DELETE FROM ASSIGNMENT_MEDICINES WHERE PATIENT_ID = p_PATIENT_ID;
END;

-- Procedury CRUD dla tabeli Statuses
CREATE OR REPLACE PROCEDURE ADD_STATUS (
    p_STATUS IN VARCHAR2,
    p_DESCRIPTION IN CLOB
) AS
BEGIN
    INSERT INTO STATUSES (ID, STATUS, DESCRIPTION, CREATED_AT, UPDATED_AT)
    VALUES (STATUSES_SEQ.NEXTVAL, p_STATUS, p_DESCRIPTION, SYSTIMESTAMP, SYSTIMESTAMP);
END ADD_STATUS;

CREATE OR REPLACE PROCEDURE GET_STATUS (
    p_ID IN NUMBER,
    p_STATUS OUT VARCHAR2,
    p_DESCRIPTION OUT CLOB,
    p_CREATED_AT OUT TIMESTAMP,
    p_UPDATED_AT OUT TIMESTAMP
) AS
BEGIN
    SELECT STATUS, DESCRIPTION, CREATED_AT, UPDATED_AT
    INTO p_STATUS, p_DESCRIPTION, p_CREATED_AT, p_UPDATED_AT
    FROM STATUSES
    WHERE ID = p_ID;
END GET_STATUS;

CREATE OR REPLACE PROCEDURE UPDATE_STATUS (
    p_ID IN NUMBER,
    p_STATUS IN VARCHAR2,
    p_DESCRIPTION IN CLOB
) AS
BEGIN
    UPDATE STATUSES
    SET STATUS = p_STATUS,
        DESCRIPTION = p_DESCRIPTION,
        UPDATED_AT = SYSTIMESTAMP
    WHERE ID = p_ID;
END UPDATE_STATUS;

CREATE OR REPLACE PROCEDURE DELETE_STATUS (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM STATUSES
    WHERE ID = p_ID;
END DELETE_STATUS;

-- Funckja do obliczania czasu
CREATE OR REPLACE FUNCTION GET_END_TIME(
    p_start_time TIMESTAMP,
    p_duration VARCHAR2
) RETURN TIMESTAMP IS
    l_end_time TIMESTAMP;
    l_hours NUMBER;
    l_minutes NUMBER;
BEGIN
    l_hours := TO_NUMBER(SUBSTR(p_duration, 1, INSTR(p_duration, ':') - 1));
    l_minutes := TO_NUMBER(SUBSTR(p_duration, INSTR(p_duration, ':') + 1));

    l_end_time := p_start_time + INTERVAL '1' HOUR * l_hours + INTERVAL '1' MINUTE * l_minutes;
    RETURN l_end_time;
END;
/

CREATE OR REPLACE PROCEDURE ADD_PROCEDURE (
    p_ID IN NUMBER,
    p_TREATMENT_TYPE_ID IN NUMBER,
    p_ROOM_ID IN NUMBER,
    p_DATE IN TIMESTAMP,
    p_DURATION IN INTERVAL DAY TO SECOND,
    p_COST IN NUMBER,
    p_STATUS IN NUMBER
) AS
    v_end_time VARCHAR2(5);
BEGIN
    v_end_time := GET_END_TIME(p_DATE, p_DURATION);
    INSERT INTO PROCEDURES (ID, TREATMENT_TYPE_ID, ROOM_ID, "DATE", "TIME", "COST", STATUS)
    VALUES (p_ID, p_TREATMENT_TYPE_ID, p_ROOM_ID, p_DATE, v_end_time, p_COST, p_STATUS);
END;

CREATE OR REPLACE PROCEDURE GET_PROCEDURE (
    p_ID IN NUMBER,
    p_TREATMENT_TYPE_ID OUT NUMBER,
    p_ROOM_ID OUT NUMBER,
    p_DATE OUT TIMESTAMP,
    p_TIME OUT VARCHAR2,
    p_COST OUT NUMBER,
    p_STATUS OUT NUMBER
) AS
BEGIN
    SELECT TREATMENT_TYPE_ID, ROOM_ID, "DATE", "TIME", "COST", STATUS
    INTO p_TREATMENT_TYPE_ID, p_ROOM_ID, p_DATE, p_TIME, p_COST, p_STATUS
    FROM PROCEDURES
    WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE UPDATE_PROCEDURE (
    p_ID IN NUMBER,
    p_TREATMENT_TYPE_ID IN NUMBER,
    p_ROOM_ID IN NUMBER,
    p_DATE IN TIMESTAMP,
    p_DURATION IN INTERVAL DAY TO SECOND,
    p_COST IN NUMBER,
    p_STATUS IN NUMBER
) AS
    v_end_time VARCHAR2(5);
BEGIN
    v_end_time := GET_END_TIME(p_DATE, p_DURATION);
    UPDATE PROCEDURES
    SET TREATMENT_TYPE_ID = p_TREATMENT_TYPE_ID,
        ROOM_ID = p_ROOM_ID,
        "DATE" = p_DATE,
        "TIME" = v_end_time,
        "COST" = p_COST,
        STATUS = p_STATUS
    WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE DELETE_PROCEDURE (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM PROCEDURES WHERE ID = p_ID;
END;

-- Hashowanie has³a
CREATE OR REPLACE FUNCTION HASH_PASSWORD(p_password IN VARCHAR2) RETURN VARCHAR2 IS
    l_hashed_password VARCHAR2(200);
BEGIN
    l_hashed_password := DBMS_CRYPTO.HASH(UTL_RAW.CAST_TO_RAW(p_password), DBMS_CRYPTO.HASH_MD5);
    RETURN l_hashed_password;
END;

-- Sprawdzanie has³a
CREATE OR REPLACE FUNCTION CHECK_PASSWORD(p_username IN VARCHAR2, p_password IN VARCHAR2) RETURN BOOLEAN IS
    l_hashed_password VARCHAR2(200);
    l_stored_password VARCHAR2(200);
BEGIN
    l_hashed_password := HASH_PASSWORD(p_password);

    SELECT PASSWORD INTO l_stored_password
    FROM USERS
    WHERE LOGIN = p_username;

    IF l_hashed_password = l_stored_password THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN FALSE;
END;
/

CREATE OR REPLACE PROCEDURE CREATE_USER (
    p_ID IN NUMBER,
    p_LOGIN IN VARCHAR2,
    p_PASSWORD IN VARCHAR2,
    p_ACCOUNT_TYPE IN NUMBER
) AS
BEGIN
    INSERT INTO USERS (ID, LOGIN, PASSWORD, ACCOUNT_TYPE)
    VALUES (p_ID, p_LOGIN, p_PASSWORD, p_ACCOUNT_TYPE);
END;

CREATE OR REPLACE PROCEDURE GET_USER (
    p_ID IN NUMBER,
    p_LOGIN OUT VARCHAR2,
    p_ACCOUNT_TYPE OUT NUMBER
) AS
BEGIN
    SELECT LOGIN, ACCOUNT_TYPE
    INTO p_LOGIN, p_ACCOUNT_TYPE
    FROM USERS
    WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE UPDATE_USER (
    p_ID IN NUMBER,
    p_LOGIN IN VARCHAR2,
    p_PASSWORD IN VARCHAR2,
    p_ACCOUNT_TYPE IN NUMBER
) AS
BEGIN
    UPDATE USERS
    SET LOGIN = p_LOGIN, PASSWORD = p_PASSWORD, ACCOUNT_TYPE = p_ACCOUNT_TYPE
    WHERE ID = p_ID;
END;

CREATE OR REPLACE PROCEDURE DELETE_USER (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM USERS WHERE ID = p_ID;
END;

-- Funkcja GET_END_TIME (powtórzenie z procedurami)
CREATE OR REPLACE FUNCTION GET_END_TIME(
    p_start_time TIMESTAMP,
    p_duration VARCHAR2
) RETURN TIMESTAMP IS
    l_end_time TIMESTAMP;
    l_hours NUMBER;
    l_minutes NUMBER;
BEGIN
    l_hours := TO_NUMBER(SUBSTR(p_duration, 1, INSTR(p_duration, ':') - 1));
    l_minutes := TO_NUMBER(SUBSTR(p_duration, INSTR(p_duration, ':') + 1));

    l_end_time := p_start_time + INTERVAL '1' HOUR * l_hours + INTERVAL '1' MINUTE * l_minutes;
    RETURN l_end_time;
END;
/

CREATE OR REPLACE PROCEDURE UPDATE_PROCEDURE_STATUSES AS
    CURSOR c_procedures IS
        SELECT ID, "DATE", TIME, STATUS
        FROM PROCEDURES
        WHERE STATUS IN (1, 2, 3);

    l_current_time TIMESTAMP;
    l_end_time TIMESTAMP;
    l_new_status_id NUMBER;
BEGIN
    l_current_time := SYSTIMESTAMP;

    FOR r IN c_procedures LOOP
        l_end_time := GET_END_TIME(r."DATE", r.TIME);

        IF l_current_time < r."DATE" THEN
            SELECT ID INTO l_new_status_id FROM STATUSES WHERE STATUS = 1;
        ELSIF l_current_time BETWEEN r."DATE" AND l_end_time THEN
            SELECT ID INTO l_new_status_id FROM STATUSES WHERE STATUS = 2;
        ELSE
            SELECT ID INTO l_new_status_id FROM STATUSES WHERE STATUS = 3;
        END IF;

        IF l_new_status_id IS NOT NULL THEN
            UPDATE PROCEDURES 
            SET STATUS = l_new_status_id
            WHERE ID = r.ID;
        ELSE
            RAISE_APPLICATION_ERROR(-20001, 'Nie mo¿na ustawiæ statusu na NULL dla ID ' || r.ID);
        END IF;
    END LOOP;

    COMMIT;
END;

BEGIN
    DBMS_SCHEDULER.create_program (
        program_name   => 'UPDATE_PROC_STATUSES_PROG',
        program_type   => 'PLSQL_BLOCK',
        program_action => 'BEGIN UPDATE_PROCEDURE_STATUSES; END;',
        number_of_arguments => 0,
        enabled        => TRUE
    );
END;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'UPDATE_PROC_STATUSES_JOB',
        program_name    => 'UPDATE_PROC_STATUSES_PROG',
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=5',
        enabled         => TRUE
    );
END;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'CHECK_AND_UPDATE_ACCOUNT_TYPES_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_AND_UPDATE_ACCOUNT_TYPES; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=1',
        enabled         => TRUE
    );
END;

-- Logowanie Doktora
CREATE TABLE doctors_audit (
    doctor_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);

CREATE OR REPLACE TRIGGER trg_doctors_audit
AFTER INSERT OR UPDATE OR DELETE ON doctors
FOR EACH ROW
BEGIN
    IF INSERTING THEN
        INSERT INTO doctors_audit (doctor_id, action, action_time)
        VALUES (:NEW.id, 'INSERT', SYSTIMESTAMP);
    ELSIF UPDATING THEN
        INSERT INTO doctors_audit (doctor_id, action, action_time)
        VALUES (:NEW.id, 'UPDATE', SYSTIMESTAMP);
    ELSIF DELETING THEN
        INSERT INTO doctors_audit (doctor_id, action, action_time)
        VALUES (:OLD.id, 'DELETE', SYSTIMESTAMP);
    END IF;
END;
/

-- Pacjent
CREATE TABLE patients_audit (
    patient_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);

CREATE OR REPLACE TRIGGER trg_patients_audit
AFTER INSERT OR UPDATE OR DELETE ON patients
FOR EACH ROW
BEGIN
    IF INSERTING THEN
        INSERT INTO patients_audit (patient_id, action, action_time)
        VALUES (:NEW.id, 'INSERT', SYSTIMESTAMP);
    ELSIF UPDATING THEN
        INSERT INTO patients_audit (patient_id, action, action_time)
        VALUES (:NEW.id, 'UPDATE', SYSTIMESTAMP);
    ELSIF DELETING THEN
        INSERT INTO patients_audit (patient_id, action, action_time)
        VALUES (:OLD.id, 'DELETE', SYSTIMESTAMP);
    END IF;
END;
/

-- Pielêgniarki
CREATE TABLE nurses_audit (
    nurse_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);

CREATE OR REPLACE TRIGGER trg_nurses_audit
AFTER INSERT OR UPDATE OR DELETE ON nurses
FOR EACH ROW
BEGIN
    IF INSERTING THEN
        INSERT INTO nurses_audit (nurse_id, action, action_time)
        VALUES (:NEW.id, 'INSERT', SYSTIMESTAMP);
    ELSIF UPDATING THEN
        INSERT INTO nurses_audit (nurse_id, action, action_time)
        VALUES (:NEW.id, 'UPDATE', SYSTIMESTAMP);
    ELSIF DELETING THEN
        INSERT INTO nurses_audit (nurse_id, action, action_time)
        VALUES (:OLD.id, 'DELETE', SYSTIMESTAMP);
    END IF;
END;
/

CREATE OR REPLACE PROCEDURE login (
    p_login IN VARCHAR2,
    p_password IN VARCHAR2,
    p_result OUT NUMBER
) IS
BEGIN
    IF CHECK_PASSWORD(p_login, p_password) THEN
        p_result := 1;
    ELSE
        p_result := 0;
    END IF;
END;
/

CREATE OR REPLACE PACKAGE szpital_stats AS
    TYPE stats_rec IS RECORD (
        patient_count NUMBER,
        procedure_count NUMBER,
        doctor_count NUMBER,
        nurse_count NUMBER
    );

    PROCEDURE get_stats(p_stats OUT stats_rec);
END szpital_stats;
/

CREATE OR REPLACE PACKAGE BODY szpital_stats AS
    PROCEDURE get_stats(p_stats OUT stats_rec) IS
    BEGIN
        SELECT COUNT(*) INTO p_stats.patient_count FROM patients;
        SELECT COUNT(*) INTO p_stats.procedure_count FROM procedures;
        SELECT COUNT(*) INTO p_stats.doctor_count FROM doctors;
        SELECT COUNT(*) INTO p_stats.nurse_count FROM nurses;
    END get_stats;
END szpital_stats;
/

-- Triger do statusu sali 
CREATE OR REPLACE TRIGGER trg_update_room_status
AFTER INSERT OR DELETE ON patients
FOR EACH ROW
DECLARE
    v_seats NUMBER;
BEGIN
    IF INSERTING THEN
        UPDATE rooms
        SET seats = seats - 1
        WHERE id = :NEW.room_id;

        SELECT seats INTO v_seats
        FROM rooms
        WHERE id = :NEW.room_id;

        IF v_seats = 0 THEN
            UPDATE rooms
            SET status = 'zajêta'
            WHERE id = :NEW.room_id;
        END IF;
    ELSIF DELETING THEN
        UPDATE rooms
        SET seats = seats + 1
        WHERE id = :OLD.room_id;

        SELECT seats INTO v_seats
        FROM rooms
        WHERE id = :OLD.room_id;

        IF v_seats > 0 THEN
            UPDATE rooms
            SET status = 'dostêpna'
            WHERE id = :OLD.room_id;
        END IF;
    END IF;
END;
/

-- Procedura sprawdzania typ konta 
CREATE OR REPLACE PROCEDURE CHECK_AND_UPDATE_ACCOUNT_TYPES AS
    CURSOR c_users IS
        SELECT ID FROM USERS;
    l_count INTEGER;
    l_user_id USERS.ID%TYPE;
BEGIN
    FOR r IN c_users LOOP
        l_user_id := r.ID;

        SELECT COUNT(*) INTO l_count FROM USERS WHERE ID = l_user_id AND ACCOUNT_TYPE = 1;
        IF l_count > 0 THEN
            CONTINUE;
        END IF;

        SELECT COUNT(*) INTO l_count FROM NURSES WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 2 WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        SELECT COUNT(*) INTO l_count FROM DOCTORS WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 3 WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        SELECT COUNT(*) INTO l_count FROM PATIENTS WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 4 WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        UPDATE USERS SET ACCOUNT_TYPE = 0 WHERE ID = l_user_id;
    END LOOP;

    COMMIT;
END;

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'JOB_CHECK_AND_UPDATE_ACCOUNT_TYPES',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_AND_UPDATE_ACCOUNT_TYPES; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=15',
        enabled         => TRUE
    );
END;
/

CREATE OR REPLACE PROCEDURE REMOVE_DUPLICATE_TREATMENTS_NURSES IS
BEGIN
    DELETE FROM TREATMENTS_NURSES A
    WHERE A.ROWID > ANY (
        SELECT B.ROWID
        FROM TREATMENTS_NURSES B
        WHERE A.NURSE_ID = B.NURSE_ID
          AND A.PROCEDURE_ID = B.PROCEDURE_ID
    );
END REMOVE_DUPLICATE_TREATMENTS_NURSES;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'JOB_REMOVE_DUPLICATE_TREATMENTS_NURSES',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN REMOVE_DUPLICATE_TREATMENTS_NURSES; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=1',
        enabled         => TRUE
    );
END;
/

BEGIN
    DBMS_SCHEDULER.drop_job (
        job_name => 'HOSPITAL.JOB_REMOVE_DUPLICATE_TREATMENTS_NURSES',
        force => TRUE
    );
END;
/

CREATE OR REPLACE PROCEDURE CHECK_ROOM_AVAILABILITY AS
BEGIN
    FOR rec IN (SELECT ID, RNUMBER, SEATS, TYPE_ROOM FROM ROOMS) LOOP
        DECLARE
            occupied_seats NUMBER;
            operating_status NUMBER;
        BEGIN
            IF rec.TYPE_ROOM = 'Dla pacjentów' THEN
                SELECT COUNT(*) INTO occupied_seats
                FROM PATIENTS
                WHERE ROOM_ID = rec.ID;

                IF occupied_seats < rec.SEATS THEN
                    UPDATE ROOMS
                    SET STATUS = 'wolny'
                    WHERE ID = rec.ID;
                ELSE
                    UPDATE ROOMS
                    SET STATUS = 'zajêty'
                    WHERE ID = rec.ID;
                END IF;

            ELSIF rec.TYPE_ROOM = 'Sala operacyjna' THEN
                SELECT STATUS INTO operating_status
                FROM (
                    SELECT STATUS
                    FROM PROCEDURES
                    WHERE ROOM_ID = rec.ID AND DATE > SYSDATE - INTERVAL '1' HOUR
                    ORDER BY DATE DESC
                ) WHERE ROWNUM = 1;

                IF operating_status = 2 THEN
                    UPDATE ROOMS
                    SET STATUS = 'zajêty'
                    WHERE ID = rec.ID;
                ELSE
                    UPDATE ROOMS
                    SET STATUS = 'wolny'
                    WHERE ID = rec.ID;
                END IF;
            END IF;
        END;
    END LOOP;
    COMMIT;
END;
/



BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'CHECK_ROOM_AVAILABILITY_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_ROOM_AVAILABILITY; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30',
        enabled         => TRUE
    );
END;
/

CREATE OR REPLACE PROCEDURE CHECK_DUPLICATE_MEDICATIONS AS
BEGIN
    FOR rec IN (
        SELECT ID, PATIENT_ID, MEDICIN_ID, EXPIRATION_DATE
        FROM ASSIGNMENT_MEDICINES
    ) LOOP
        DECLARE
            duplicate_count NUMBER;
        BEGIN
            SELECT COUNT(*)
            INTO duplicate_count
            FROM ASSIGNMENT_MEDICINES
            WHERE PATIENT_ID = rec.PATIENT_ID
            AND MEDICIN_ID = rec.MEDICIN_ID
            AND EXPIRATION_DATE = rec.EXPIRATION_DATE
            AND ID != rec.ID;

            IF duplicate_count > 0 THEN
                DELETE FROM ASSIGNMENT_MEDICINES
                WHERE ID = rec.ID;
            END IF;
        END;
    END LOOP;
    COMMIT;
END;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'CHECK_DUPLICATE_MEDICATIONS_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_DUPLICATE_MEDICATIONS; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30', -- dostosuj wed³ug potrzeb
        enabled         => TRUE
    );
END;
/

CREATE OR REPLACE PROCEDURE REMOVE_DUPLICATE_ASSIGNMENTS AS
BEGIN
    FOR rec IN (
        SELECT ID, NURSE_ID, PROCEDURE_ID
        FROM TREATMENTS_NURSES
    ) LOOP
        DECLARE
            duplicate_count NUMBER;
        BEGIN
            SELECT COUNT(*)
            INTO duplicate_count
            FROM TREATMENTS_NURSES
            WHERE NURSE_ID = rec.NURSE_ID
            AND PROCEDURE_ID = rec.PROCEDURE_ID
            AND ID != rec.ID;

            IF duplicate_count > 0 THEN
                DELETE FROM TREATMENTS_NURSES
                WHERE ID = rec.ID;
            END IF;
        END;
    END LOOP;
    COMMIT;
END;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'REMOVE_DUPLICATE_ASSIGNMENTS_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN REMOVE_DUPLICATE_ASSIGNMENTS; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30', -- dostosuj wed³ug potrzeb
        enabled         => TRUE
    );
END;
/

CREATE OR REPLACE PROCEDURE REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS AS
BEGIN
    FOR rec IN (
        SELECT ID, DOCTOR_ID, PROCEDURE_ID
        FROM TREATMENTS_DOCTORS
    ) LOOP
        DECLARE
            duplicate_count NUMBER;
        BEGIN
            SELECT COUNT(*)
            INTO duplicate_count
            FROM TREATMENTS_DOCTORS
            WHERE DOCTOR_ID = rec.DOCTOR_ID
            AND PROCEDURE_ID = rec.PROCEDURE_ID
            AND ID != rec.ID;

            IF duplicate_count > 0 THEN
                DELETE FROM TREATMENTS_DOCTORS
                WHERE ID = rec.ID;
            END IF;
        END;
    END LOOP;
    COMMIT;
END;
/

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30', -- dostosuj wed³ug potrzeb
        enabled         => TRUE
    );
END;
/

