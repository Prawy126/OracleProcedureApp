

create or replace trigger doctors_id_trg
            before insert on DOCTORS
            for each row
                begin
            if :new.ID is null then
                select doctors_id_seq.nextval into :new.ID from dual;
            end if;
            end;