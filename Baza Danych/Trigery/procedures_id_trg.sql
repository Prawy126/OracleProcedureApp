create or replace trigger procedures_id_trg
            before insert on PROCEDURES
            for each row
                begin
            if :new.ID is null then
                select procedures_id_seq.nextval into :new.ID from dual;
            end if;
            end;