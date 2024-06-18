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
            RAISE_APPLICATION_ERROR(-20001, 'Nie można ustawić statusu na NULL dla ID ' || r.ID);
        END IF;
    END LOOP;

    COMMIT;
END;
/


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
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30',
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
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=30',
        enabled         => TRUE
    );
END;
/