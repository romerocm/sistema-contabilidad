
-- pepsComprasInsert

BEGIN
DECLARE tot varchar(200);
SET tot=(new.qty)*(new.price);
INSERT INTO peps VALUES(new.id, CURRENT_TIMESTAMP(),new.name,new.qty,new.price,tot);
END;

-- pepsComprasUpdate