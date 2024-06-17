create or replace trigger migrations_id_trg
            before insert on MIGRATIONS
            for each row
                begin
            if :new.ID is null then
                select migrations_id_seq.nextval into :new.ID from dual;
            end if;
            end;