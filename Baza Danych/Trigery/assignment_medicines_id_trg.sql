create or replace trigger assignment_medicines_id_trg
            before insert on ASSIGNMENT_MEDICINES
            for each row
                begin
            if :new.ID is null then
                select assignment_medicines_id_seq.nextval into :new.ID from dual;
            end if;
            end;