create or replace FUNCTION HASH_PASSWORD(p_password IN VARCHAR2) RETURN VARCHAR2 IS
    l_hashed_password VARCHAR2(200);
BEGIN
    l_hashed_password := DBMS_CRYPTO.HASH(UTL_RAW.CAST_TO_RAW(p_password), DBMS_CRYPTO.HASH_MD5);
    RETURN l_hashed_password;
END;
/