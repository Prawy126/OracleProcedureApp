create or replace PROCEDURE ADD_NURSE(
    p_name IN VARCHAR2,
    p_surname IN VARCHAR2,
    p_number IN VARCHAR2,
    p_user_id IN NUMBER)
IS
BEGIN
    INSERT INTO NURSES (NAME, SURNAME, NUMBER_LICENSE, USER_ID)
    VALUES (p_name, p_surname, p_number, p_user_id);
END;
/
create or replace PROCEDURE DELETE_NURSE(
    p_nurse_id IN NUMBER)
IS
BEGIN
    DELETE FROM nurses WHERE id = p_nurse_id;
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