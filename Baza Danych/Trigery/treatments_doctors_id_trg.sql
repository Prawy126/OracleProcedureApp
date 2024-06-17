create or replace trigger treatments_doctors_id_trg
            before insert on TREATMENTS_DOCTORS
            for each row
                begin
            if :new.ID is null then
                select treatments_doctors_id_seq.nextval into :new.ID from dual;
            end if;
            end;