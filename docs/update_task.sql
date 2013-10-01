UPDATE tm_task SET parent_id =181 WHERE id IN (
SELECT child_id
FROM  `tm_task_relation`
)