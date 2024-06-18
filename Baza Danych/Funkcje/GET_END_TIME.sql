create or replace FUNCTION GET_END_TIME(
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
/