--pakiet u�ytkownik�w
CREATE OR REPLACE PACKAGE users_pkg IS

    -- Composite record types
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
        NUMBER_LICENSE        VARCHAR2(30),
        user_id         NUMBER
    );

    -- Procedure declarations
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

CREATE OR REPLACE PACKAGE BODY users_pkg IS

    -- Add a doctor
    PROCEDURE add_doctor(p_doctor IN doctor_rec) IS
    BEGIN
        INSERT INTO doctors (name, surname, specialization, license_number, user_id)
        VALUES (p_doctor.name, p_doctor.surname, p_doctor.specialization, p_doctor.license_number, p_doctor.user_id);
    END add_doctor;

    -- Get a doctor
    PROCEDURE get_doctor(p_doctor_id IN NUMBER, p_doctor OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_doctor FOR
        SELECT * FROM doctors WHERE id = p_doctor_id;
    END get_doctor;

    -- Update a doctor
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
    PROCEDURE delete_doctor(p_doctor_id IN NUMBER) IS
    BEGIN
        DELETE FROM doctors WHERE id = p_doctor_id;
    END delete_doctor;

    -- Add a patient
    PROCEDURE add_patient(p_patient IN patient_rec) IS
    BEGIN
        INSERT INTO patients (name, surname, nurse_id, user_id, time_visit, room_id)
        VALUES (p_patient.name, p_patient.surname, p_patient.nurse_id, p_patient.user_id, p_patient.time_visit, p_patient.room_id);
    END add_patient;

    -- Get a patient
    PROCEDURE get_patient(p_patient_id IN NUMBER, p_patient OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_patient FOR
        SELECT * FROM patients WHERE id = p_patient_id;
    END get_patient;

    -- Update a patient
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

    -- Delete a patient
    PROCEDURE delete_patient(p_patient_id IN NUMBER) IS
    BEGIN
        DELETE FROM patients WHERE id = p_patient_id;
    END delete_patient;

    -- Add a nurse
    PROCEDURE add_nurse(p_nurse IN nurse_rec) IS
    BEGIN
        INSERT INTO nurses (name, surname, NUMBER_LICENSE, user_id)
        VALUES (p_nurse.name, p_nurse.surname, p_nurse.NUMBER_LICENSE, p_nurse.user_id);
    END add_nurse;

    -- Get a nurse
    PROCEDURE get_nurse(p_nurse_id IN NUMBER, p_nurse OUT SYS_REFCURSOR) IS
    BEGIN
        OPEN p_nurse FOR
        SELECT * FROM nurses WHERE id = p_nurse_id;
    END get_nurse;

    -- Update a nurse
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
    BEGIN
        DELETE FROM nurses WHERE id = p_nurse_id;
    END delete_nurse;

END users_pkg;

-- pakiet elementy szpitalu
CREATE OR REPLACE PACKAGE szpital AS
    -- Typy rekord�w
    TYPE medicin_rec IS RECORD (
        id NUMBER,
        name VARCHAR2(200),
        instruction CLOB,
        warehouse_quantity NUMBER,
        drug_category VARCHAR2(200),
        price NUMBER,
        dose_unit VARCHAR2(200)
    );

    TYPE room_rec IS RECORD (
        id NUMBER,
        rnumber VARCHAR2(200),
        rlocation VARCHAR2(200),
        status VARCHAR2(200),
        type_room VARCHAR2(200),
        seats INTEGER
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

    -- Procedury dla medicins
    PROCEDURE add_medicine(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
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
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    );

    PROCEDURE delete_medicin(
        p_medicin_id IN NUMBER
    );

    -- Procedury dla rooms
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
        p_type_room IN VARCHAR2
    );

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    );

    -- Procedury dla treatment_types
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


CREATE OR REPLACE PACKAGE BODY szpital AS

    -- Procedury dla medicins
    PROCEDURE add_medicine(
        p_name IN VARCHAR2,
        p_instruction IN CLOB,
        p_warehouse_quantity IN NUMBER,
        p_drug_category IN VARCHAR2,
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        INSERT INTO MEDICINS ("NAME", "INSTRUCTION", "WAREHOUSE_QUANTITY", "DRUG_CATEGORY", "PRICE", "DOSE_UNIT")
        VALUES (p_name, p_instruction, p_warehouse_quantity, p_drug_category, p_price, p_dose_unit);
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
        p_price IN NUMBER,
        p_dose_unit IN VARCHAR2
    ) IS
    BEGIN
        UPDATE medicins
        SET name = p_name,
            instruction = p_instruction,
            warehouse_quantity = p_warehouse_quantity,
            drug_category = p_drug_category,
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

    -- Procedury dla rooms
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
        p_type_room IN VARCHAR2
    ) IS
    BEGIN
        UPDATE rooms
        SET rnumber = p_rnumber,
            rlocation = p_rlocation,
            status = p_status,
            type_room = p_type_room
        WHERE id = p_room_id;
    END update_room;

    PROCEDURE delete_room(
        p_room_id IN NUMBER
    ) IS
    BEGIN
        DELETE FROM rooms WHERE id = p_room_id;
    END delete_room;

    -- Procedury dla treatment_types
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
        SET NAME = p_NAME, DESCRIPTION = p_DESCRIPTION, RECOMMENDATIONS_BEFORE_SURGERY = p_RECOMMENDATIONS_AFTER_SURGERY,
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


--sekwencja

CREATE SEQUENCE TREATMENTS_DOCTORS_USERS_ID_SEQ
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;


CREATE OR REPLACE PROCEDURE ADD_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER
    
) AS
BEGIN
    INSERT INTO TREATMENTS_DOCTORS (ID,PROCEDURE_ID, DOCTOR_ID, CREATED_AT)
    VALUES (TREATMENTS_DOCTORS_ID_SEQ.NEXTVAL,p_PROCEDURE_ID, p_DOCTOR_ID, SYSTIMESTAMP);
END;

CREATE OR REPLACE PROCEDURE GET_TREATMENTS_DOCTORS (
    p_DOCTOR_ID IN NUMBER,
    p_RESULT OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_RESULT FOR
    SELECT PROCEDURE_ID
    FROM TREATMENTS_DOCTORS
    WHERE DOCTOR_ID = p_DOCTOR_ID;
END;





-- procedury crudowe
CREATE OR REPLACE PROCEDURE UPDATE_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER,
    p_CREATED_AT IN TIMESTAMP,
    p_UPDATED_AT IN TIMESTAMP
) AS
BEGIN
    UPDATE TREATMENTS_DOCTORS
    SET DOCTOR_ID = p_DOCTOR_ID, CREATED_AT = p_CREATED_AT, UPDATED_AT = p_UPDATED_AT
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

--sekwencje
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

--kolejne procedury crudowe
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

-- funckja do obliczania czasu
CREATE OR REPLACE FUNCTION GET_END_TIME(
    p_start_time TIMESTAMP,
    p_duration INTERVAL DAY TO SECOND
) RETURN VARCHAR2 IS
    l_end_time TIMESTAMP;
BEGIN
    l_end_time := p_start_time + p_duration;
    RETURN TO_CHAR(l_end_time, 'HH24:MI');
END;


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

--Hashowanie has?a
CREATE OR REPLACE FUNCTION HASH_PASSWORD(p_password IN VARCHAR2) RETURN VARCHAR2 IS
    l_hashed_password VARCHAR2(200);
BEGIN
    l_hashed_password := DBMS_CRYPTO.HASH(UTL_RAW.CAST_TO_RAW(p_password), DBMS_CRYPTO.HASH_MD5);
    RETURN l_hashed_password;
END;

-- Sorawdzanie has�a
CREATE OR REPLACE FUNCTION CHECK_PASSWORD(p_username IN VARCHAR2, p_password IN VARCHAR2) RETURN BOOLEAN IS
    l_hashed_password VARCHAR2(200);
    l_stored_password VARCHAR2(200);
BEGIN
    -- Hashujemy podane has�o
    l_hashed_password := HASH_PASSWORD(p_password);

    -- Pobieramy zapisane has�o z bazy
    SELECT PASSWORD INTO l_stored_password
    FROM USERS
    WHERE LOGIN = p_username;

    -- Sprawdzamy, czy hashe s� zgodne
    IF l_hashed_password = l_stored_password THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        -- Gdy u�ytkownik nie istnieje
        RETURN FALSE;
END;
/


CREATE OR REPLACE PROCEDURE CREATE_USER (
    p_ID IN NUMBER,
    p_LOGIN IN VARCHAR2,
    p_PASSWORD IN VARCHAR2,
    p_ACCOUNT_TYPE IN VARCHAR2
) AS
BEGIN
    INSERT INTO USERS (ID, LOGIN, PASSWORD, ACCOUNT_TYPE)
    VALUES (p_ID, p_LOGIN, p_PASSWORD, p_ACCOUNT_TYPE);
END;

CREATE OR REPLACE PROCEDURE GET_USER (
    p_ID IN NUMBER,
    p_LOGIN OUT VARCHAR2,
    p_ACCOUNT_TYPE OUT VARCHAR2
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
    p_ACCOUNT_TYPE IN VARCHAR2
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

CREATE OR REPLACE FUNCTION GET_END_TIME(
    p_start_time TIMESTAMP,
    p_duration VARCHAR2
) RETURN TIMESTAMP IS
    l_end_time TIMESTAMP;
    l_hours NUMBER;
    l_minutes NUMBER;
BEGIN
    -- Parse the duration string into hours and minutes
    l_hours := TO_NUMBER(SUBSTR(p_duration, 1, INSTR(p_duration, ':') - 1));
    l_minutes := TO_NUMBER(SUBSTR(p_duration, INSTR(p_duration, ':') + 1));

    -- Calculate the end time
    l_end_time := p_start_time + INTERVAL '1' HOUR * l_hours + INTERVAL '1' MINUTE * l_minutes;
    RETURN l_end_time;
END;


CREATE OR REPLACE PROCEDURE UPDATE_PROCEDURE_STATUSES AS
    CURSOR c_procedures IS
        SELECT ID, "DATE", TIME, STATUS
        FROM PROCEDURES
        WHERE STATUS IN (1, 2, 3); -- 1: przed zabiegiem, 2: w trakcie, 3: ju� po

    l_current_time TIMESTAMP;
    l_end_time TIMESTAMP;
    l_description CLOB;
BEGIN
    l_current_time := SYSTIMESTAMP;

    FOR r IN c_procedures LOOP
        l_end_time := GET_END_TIME(r."DATE", r.TIME);

        IF l_current_time < r."DATE" THEN
            -- Przed zabiegiem
            UPDATE PROCEDURES SET STATUS = 1 WHERE ID = r.ID;
            l_description := 'Przed zabiegiem';
        ELSIF l_current_time BETWEEN r."DATE" AND l_end_time THEN
            -- W trakcie zabiegu
            UPDATE PROCEDURES SET STATUS = 2 WHERE ID = r.ID;
            l_description := 'W trakcie zabiegu';
        ELSE
            -- Ju� po zabiegu
            UPDATE PROCEDURES SET STATUS = 3 WHERE ID = r.ID;
            l_description := 'Ju� po zabiegu';
        END IF;

        -- Aktualizacja opisu w tabeli STATUSES
        UPDATE STATUSES SET DESCRIPTION = l_description WHERE ID = r.ID;
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
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=5',  -- co 5 minut
        enabled         => TRUE
    );
END;
/

-- Utworzenie wyzwalacza
CREATE OR REPLACE TRIGGER trg_update_procedure_statuses
AFTER INSERT OR UPDATE OR DELETE ON PROCEDURES
BEGIN
    UPDATE_PROCEDURE_STATUSES;
END;


BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'CHECK_AND_UPDATE_ACCOUNT_TYPES_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_AND_UPDATE_ACCOUNT_TYPES; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=1', -- Wykonywanie co minut�
        enabled         => TRUE
    );
END;

-- Logowanie Doktora
CREATE TABLE doctors_audit (
    doctor_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);

-- Triger do logowania doktora
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

--Pacjent
-- Logowanie Patienta
CREATE TABLE patients_audit (
    patient_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);

-- Triger do logowania patienta
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

--Piel�gniarki
-- Logowanie Piel�gniarki
CREATE TABLE nurses_audit (
    nurse_id NUMBER,
    action VARCHAR2(10),
    action_time TIMESTAMP
);
-- Triger do logowania piel�gniarki
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
    -- Use the CHECK_PASSWORD function to validate the password
    IF CHECK_PASSWORD(p_login, p_password) THEN
        p_result := 1; -- TRUE
    ELSE
        p_result := 0; -- FALSE
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

--triger do statusu sali 
CREATE OR REPLACE TRIGGER trg_update_room_status
AFTER INSERT OR DELETE ON patients
FOR EACH ROW
DECLARE
    v_seats NUMBER;
BEGIN
    -- Je�li pacjent jest dodawany
    IF INSERTING THEN
        -- Zmniejsz liczb� dost�pnych miejsc
        UPDATE rooms
        SET seats = seats - 1
        WHERE id = :NEW.room_id;

        -- Sprawd� now� liczb� miejsc
        SELECT seats INTO v_seats
        FROM rooms
        WHERE id = :NEW.room_id;

        -- Je�li liczba miejsc wynosi 0, ustaw status na "zaj�ta"
        IF v_seats = 0 THEN
            UPDATE rooms
            SET status = 'zaj�ta'
            WHERE id = :NEW.room_id;
        END IF;

    -- Je�li pacjent jest usuwany
    ELSIF DELETING THEN
        -- Zwi�ksz liczb� dost�pnych miejsc
        UPDATE rooms
        SET seats = seats + 1
        WHERE id = :OLD.room_id;

        -- Sprawd� now� liczb� miejsc
        SELECT seats INTO v_seats
        FROM rooms
        WHERE id = :OLD.room_id;

        -- Je�li liczba miejsc jest wi�ksza ni� 0, ustaw status na "dost�pna"
        IF v_seats > 0 THEN
            UPDATE rooms
            SET status = 'dost�pna'
            WHERE id = :OLD.room_id;
        END IF;
    END IF;
END;
/

-- sprawdzanie typ konta 
CREATE OR REPLACE PROCEDURE CHECK_AND_UPDATE_ACCOUNT_TYPES AS
    CURSOR c_users IS
        SELECT ID FROM USERS;
    l_count INTEGER;
    l_user_id USERS.ID%TYPE;
BEGIN
    FOR r IN c_users LOOP
        l_user_id := r.ID;

        -- Sprawdzenie i aktualizacja dla administrator�w
        SELECT COUNT(*) INTO l_count FROM USERS WHERE ID = l_user_id AND ACCOUNT_TYPE = 'admin';
        IF l_count > 0 THEN
            CONTINUE;  -- Je�li u�ytkownik jest adminem, nie aktualizujemy jego typu konta
        END IF;

        -- Sprawdzenie i aktualizacja dla piel�gniarek
        SELECT COUNT(*) INTO l_count FROM NURSES WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 'nurse' WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        -- Sprawdzenie i aktualizacja dla lekarzy
        SELECT COUNT(*) INTO l_count FROM DOCTORS WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 'doctor' WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        -- Sprawdzenie i aktualizacja dla pacjent�w
        SELECT COUNT(*) INTO l_count FROM PATIENTS WHERE USER_ID = l_user_id;
        IF l_count > 0 THEN
            UPDATE USERS SET ACCOUNT_TYPE = 'patient' WHERE ID = l_user_id;
            CONTINUE;
        END IF;

        -- Je�li nie ma przypisania, ustawienie na 'none'
        UPDATE USERS SET ACCOUNT_TYPE = 'none' WHERE ID = l_user_id;
    END LOOP;

    COMMIT;
END;

BEGIN
    DBMS_SCHEDULER.create_job (
        job_name        => 'JOB_CHECK_AND_UPDATE_ACCOUNT_TYPES',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN CHECK_AND_UPDATE_ACCOUNT_TYPES; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=MINUTELY; INTERVAL=5', -- Uruchamianie co 5 minut
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





