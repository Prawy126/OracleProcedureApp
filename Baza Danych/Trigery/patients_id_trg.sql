create or replace trigger patients_id_trg
            before insert on PATIENTS
            for each row
                begin
            if :new.ID is null then
                select patients_id_seq.nextval into :new.ID from dual;
            end if;
            end;