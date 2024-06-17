create or replace trigger treatment_types_id_trg
            before insert on TREATMENT_TYPES
            for each row
                begin
            if :new.ID is null then
                select treatment_types_id_seq.nextval into :new.ID from dual;
            end if;
            end;