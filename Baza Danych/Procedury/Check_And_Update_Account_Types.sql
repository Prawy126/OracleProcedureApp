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