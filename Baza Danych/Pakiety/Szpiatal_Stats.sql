create or replace PACKAGE szpital_stats AS
    TYPE stats_rec IS RECORD (
        patient_count NUMBER,
        procedure_count NUMBER,
        doctor_count NUMBER,
        nurse_count NUMBER
    );

    PROCEDURE get_stats(p_stats OUT stats_rec);
END szpital_stats;

create or replace PACKAGE BODY szpital_stats AS
    PROCEDURE get_stats(p_stats OUT stats_rec) IS
    BEGIN
        SELECT COUNT(*) INTO p_stats.patient_count FROM patients;
        SELECT COUNT(*) INTO p_stats.procedure_count FROM procedures;
        SELECT COUNT(*) INTO p_stats.doctor_count FROM doctors;
        SELECT COUNT(*) INTO p_stats.nurse_count FROM nurses;
    END get_stats;
END szpital_stats;