create or replace PROCEDURE ADD_MEDICIN(
    p_name IN VARCHAR2,
    p_instruction IN CLOB,
    p_warehouse_quantity IN NUMBER,
    p_drug_category IN VARCHAR2,
    p_drug_form IN VARCHAR2,
    p_price IN NUMBER,
    p_dose_unit IN VARCHAR2
)
IS
BEGIN
    INSERT INTO MEDICINS (ID ,NAME, INSTRUCTION, WAREHOUSE_QUANTITY, DRUG_CATEGORY, DRUG_FORM, PRICE, DOSE_UNIT)
    VALUES (MEDICINS_ID_SEQ.NEXTVAL, p_name, p_instruction, p_warehouse_quantity, p_drug_category, p_drug_form, p_price, p_dose_unit);
END;
/
create or replace PROCEDURE DELETE_MEDICIN(
    p_medicin_id IN NUMBER)
IS
BEGIN
    DELETE FROM medicins WHERE id = p_medicin_id;
END;
/
create or replace PROCEDURE GET_MEDICINE(
    p_mdicine_id IN NUMBER,
    p_medicine OUT SYS_REFCURSOR)
IS
BEGIN
    OPEN p_medicine FOR
    SELECT * FROM MEDICINS WHERE ID = p_mdicine_id;
END;
/
create or replace PROCEDURE UPDATE_MEDICIN(
    p_medicin_id IN NUMBER,
    p_name IN VARCHAR2,
    p_instruction IN CLOB,
    p_warehouse_quantity IN NUMBER,
    p_drug_category IN VARCHAR2,
    p_price IN NUMBER,
    p_dose_unit IN VARCHAR2)
IS
BEGIN
    UPDATE medicins
    SET name = p_name,
        instruction = p_instruction,
        warehouse_quantity = p_warehouse_quantity,
        drug_category = p_drug_category,
        price = p_price,
        dose_unit = p_dose_unit
    WHERE id = p_medicin_id;
END;
/