create or replace PROCEDURE ADD_TREATMENTS_NURSES (
    p_NURSE_ID IN NUMBER,
    p_PROCEDURE_ID IN NUMBER
    
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

    -- Sprawdź, czy pielęgniarka ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        JOIN TREATMENTS_NURSES TN ON P.ID = TN.PROCEDURE_ID
        WHERE TN.NURSE_ID = p_NURSE_ID
    ) LOOP
        IF (l_start_time BETWEEN rec.DATE AND rec.END_TIME)
           OR (l_end_time BETWEEN rec.DATE AND rec.END_TIME)
           OR (rec.DATE BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20002, 'Nurse is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, dodaj nowy wpis do TREATMENTS_NURSES
    INSERT INTO TREATMENTS_NURSES (ID, PROCEDURE_ID, NURSE_ID)
    VALUES (TREATMENTS_NURSES_ID_SEQ.NEXTVAL, p_PROCEDURE_ID, p_NURSE_ID);
END;


create or replace PROCEDURE DELETE_TREATMENTS_NURSES (
    p_ID IN NUMBER
) AS
BEGIN
    DELETE FROM TREATMENTS_NURSES WHERE ID = p_ID;
END;

create or replace PROCEDURE GET_TREATMENTS_NURSES (
    p_ID IN NUMBER,
    p_RESULT OUT SYS_REFCURSOR
) AS
BEGIN
    OPEN p_RESULT FOR
    SELECT * FROM TREATMENTS_NURSES
    WHERE ID = p_ID;
END;

create or replace PROCEDURE UPDATE_TREATMENTS_NURSES (
    p_ID IN NUMBER,
    p_NEW_NURSE_ID IN NUMBER,
    p_NEW_PROCEDURE_ID IN NUMBER
) AS
    l_start_time TIMESTAMP;
    l_duration VARCHAR2(255);
    l_end_time TIMESTAMP;
BEGIN
    -- Pobierz czas rozpoczęcia i długość trwania aktualizowanego zabiegu
    SELECT "DATE", "TIME" INTO l_start_time, l_duration
    FROM PROCEDURES
    WHERE ID = p_NEW_PROCEDURE_ID;

    -- Oblicz czas zakończenia aktualizowanego zabiegu
    l_end_time := GET_END_TIME(l_start_time, l_duration);

    -- Sprawdź, czy pielęgniarka ma już zaplanowany zabieg w danym przedziale czasowym
    FOR rec IN (
        SELECT P."DATE", P."TIME", GET_END_TIME(P."DATE", P."TIME") AS END_TIME
        FROM PROCEDURES P
        JOIN TREATMENTS_NURSES TN ON P.ID = TN.PROCEDURE_ID
        WHERE TN.NURSE_ID = p_NEW_NURSE_ID AND P.ID != p_NEW_PROCEDURE_ID
    ) LOOP
        IF (l_start_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (l_end_time BETWEEN rec."DATE" AND rec.END_TIME)
           OR (rec."DATE" BETWEEN l_start_time AND l_end_time) THEN
            RAISE_APPLICATION_ERROR(-20005, 'Nurse is not available at the specified time.');
        END IF;
    END LOOP;

    -- Jeśli brak konfliktów, zaktualizuj wpis w TREATMENTS_NURSES
    UPDATE TREATMENTS_NURSES
    SET NURSE_ID = p_NEW_NURSE_ID,
        PROCEDURE_ID = p_NEW_PROCEDURE_ID
    WHERE ID = p_ID;
END;