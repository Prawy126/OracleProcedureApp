create or replace PROCEDURE ADD_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER
) AS
    l_start_time TIMESTAMP;
    l_duration VARCHAR2(255);
    l_end_time TIMESTAMP;
BEGIN
    -- Pobierz czas rozpoczęcia i długość trwania nowego zabiegu
    SELECT "DATE", "TIME" INTO l_start_time, l_duration
    FROM PROCEDURES
    WHERE ID = p_PROCEDURE_ID;

    -- Oblicz czas zakończenia nowego zabiegu
    l_end_time := GET_END_TIME(l_start_time, l_duration);

    -- Sprawdź, czy doktor ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT T."DATE", T."TIME", GET_END_TIME(T."DATE", T."TIME") AS END_TIME
        FROM PROCEDURES T
        JOIN TREATMENTS_DOCTORS TD ON T.ID = TD.PROCEDURE_ID
        WHERE TD.DOCTOR_ID = p_DOCTOR_ID
    ) LOOP
        IF (l_start_time BETWEEN rec.DATE AND rec.END_TIME)
           OR (l_end_time BETWEEN rec.DATE AND rec.END_TIME)
           OR (rec.DATE BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20001, 'Doctor is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, dodaj nowy wpis do TREATMENTS_DOCTORS
    INSERT INTO TREATMENTS_DOCTORS (ID, PROCEDURE_ID, DOCTOR_ID, CREATED_AT)
    VALUES (TREATMENTS_DOCTORS_ID_SEQ.NEXTVAL, p_PROCEDURE_ID, p_DOCTOR_ID, SYSTIMESTAMP);
END;
/
create or replace PROCEDURE DELETE_TREATMENTS_DOCTORS (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM TREATMENTS_DOCTORS WHERE ID = p_ID;
END;
/
create or replace PROCEDURE GET_TREATMENTS_DOCTORS (
    p_ID IN NUMBER,
    p_RESULT OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_RESULT FOR
    SELECT * FROM TREATMENTS_DOCTORS
    WHERE ID = p_ID;
END;
/
create or replace PROCEDURE UPDATE_TREATMENTS_DOCTORS (
    p_PROCEDURE_ID IN NUMBER,
    p_DOCTOR_ID IN NUMBER
) AS
    l_start_time TIMESTAMP;
    l_duration VARCHAR2(255);
    l_end_time TIMESTAMP;
BEGIN
    -- Pobierz czas rozpoczęcia i długość trwania aktualizowanego zabiegu
    SELECT "DATE", "TIME" INTO l_start_time, l_duration
    FROM PROCEDURES
    WHERE ID = p_PROCEDURE_ID;

    -- Oblicz czas zakończenia aktualizowanego zabiegu
    l_end_time := GET_END_TIME(l_start_time, l_duration);

    -- Sprawdź, czy lekarz ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        JOIN TREATMENTS_DOCTORS TD ON P.ID = TD.PROCEDURE_ID
        WHERE TD.DOCTOR_ID = p_DOCTOR_ID AND P.ID != p_PROCEDURE_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20004, 'Doctor is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, zaktualizuj wpis w TREATMENTS_DOCTORS
    UPDATE TREATMENTS_DOCTORS
    SET DOCTOR_ID = p_DOCTOR_ID
    WHERE PROCEDURE_ID = p_PROCEDURE_ID;
END;
/