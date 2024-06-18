CREATE OR REPLACE PROCEDURE ADD_PROCEDURE (
    p_TREATMENT_TYPE_ID IN NUMBER,
    p_ROOM_ID IN NUMBER,
    p_DATE IN TIMESTAMP,
    p_DURATION IN VARCHAR2,
    p_COST IN NUMBER,
    p_PATIENT_ID IN NUMBER
) AS
    l_start_time TIMESTAMP;
    l_end_time TIMESTAMP;
BEGIN
    -- Oblicz czas zakończenia nowego zabiegu
    l_start_time := p_DATE;
    l_end_time := GET_END_TIME(p_DATE, p_DURATION);

    -- Sprawdź, czy pacjent ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        WHERE P.PATIENT_ID = p_PATIENT_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20003, 'Patient is not available at the specified time.');
        END IF;
    END LOOP;

    -- Sprawdź, czy sala jest już zajęta w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        WHERE P.ROOM_ID = p_ROOM_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20004, 'Room is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, dodaj nowy wpis do PROCEDURES
    INSERT INTO PROCEDURES (ID, TREATMENT_TYPE_ID, ROOM_ID, "DATE", "TIME", "COST", STATUS, PATIENT_ID)
    VALUES (PROCEDURES_ID_SEQ.NEXTVAL, p_TREATMENT_TYPE_ID, p_ROOM_ID, p_DATE, p_DURATION, p_COST, 1, p_PATIENT_ID);
END;
/
create or replace PROCEDURE UPDATE_NURSE(
    p_nurse_id IN NUMBER,
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_number IN VARCHAR2,
    p_user_id IN NUMBER)
IS
BEGIN
    UPDATE nurses
    SET name = p_name,
        surname = p_surname,
        number_license = p_number,
        user_id = p_user_id
    WHERE id = p_nurse_id;
END;
/
create or replace PROCEDURE DELETE_PROCEDURE(
    p_procedure_id IN NUMBER
) IS
BEGIN
    BEGIN
        DELETE FROM procedures WHERE id = p_procedure_id;
    EXCEPTION
        WHEN OTHERS THEN
            IF SQLCODE = -2292 THEN
                RAISE_APPLICATION_ERROR(-20001, 'Nie można usunąć procedury, która jest już przypisana.');
            ELSE
                RAISE;
            END IF;
    END;
END;
/
create or replace PROCEDURE GET_PROCEDURE (
    p_ID IN NUMBER,
    p_procedure OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_procedure FOR
    SELECT "ID",TREATMENT_TYPE_ID, ROOM_ID, "DATE", "TIME", "COST", STATUS, PATIENT_ID
    FROM PROCEDURES
    WHERE ID = p_ID;
END;
/
create or replace PROCEDURE UPDATE_PROCEDURE (
    p_ID IN NUMBER,
    p_TREATMENT_TYPE_ID IN NUMBER,
    p_ROOM_ID IN NUMBER,
    p_DATE IN TIMESTAMP,
    p_DURATION IN VARCHAR2,
    p_COST IN NUMBER,
    p_PATIENT_ID IN NUMBER
) AS
    l_start_time TIMESTAMP;
    l_end_time TIMESTAMP;
BEGIN
    -- Oblicz czas zakończenia nowego zabiegu
    l_start_time := p_DATE;
    l_end_time := GET_END_TIME(p_DATE, p_DURATION);

    -- Sprawdź, czy pacjent ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        WHERE P.PATIENT_ID = p_PATIENT_ID AND P.ID != p_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20003, 'Patient is not available at the specified time.');
        END IF;
    END LOOP;

    -- Sprawdź, czy sala jest już zajęta w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        WHERE P.ROOM_ID = p_ROOM_ID AND P.ID != p_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20004, 'Room is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, zaktualizuj wpis w PROCEDURES
    UPDATE PROCEDURES
    SET TREATMENT_TYPE_ID = p_TREATMENT_TYPE_ID,
        ROOM_ID = p_ROOM_ID,
        "DATE" = p_DATE,
        "TIME" = p_DURATION,
        "COST" = p_COST,
        PATIENT_ID = p_PATIENT_ID,
        STATUS = 1
    WHERE ID = p_ID;
END;
/