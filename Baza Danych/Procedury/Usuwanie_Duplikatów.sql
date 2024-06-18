create or replace PROCEDURE REMOVE_DUPLICATE_ASSIGNMENTS AS
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
create or replace PROCEDURE REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS AS
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
create or replace PROCEDURE REMOVE_DUPLICATE_TREATMENTS_NURSES IS
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
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30',
        enabled         => TRUE
    );
END;
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
    DBMS_SCHEDULER.create_job (
        job_name        => 'REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS_JOB',
        job_type        => 'PLSQL_BLOCK',
        job_action      => 'BEGIN REMOVE_DUPLICATE_DOCTOR_ASSIGNMENTS; END;',
        start_date      => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30', -- dostosuj według potrzeb
        enabled         => TRUE
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
                    SET STATUS = 'zajęty'
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
                    SET STATUS = 'zajęty'
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