USE praktikum_web_2401020007;

INSERT INTO program_studi (nama_prodi) VALUES
    ('Teknik Informatika'),
    ('Teknik Elektro');

INSERT INTO mahasiswa
    (nim, nama, email, usia, program_studi_id)
VALUES
    ('2401020007', 'Alfa Julyana', 'alfa.julyana@example.com', 20, 1),
    ('2401020015', 'Rizky Ramadhan', 'rizky@example.com', 21, 1),
    ('2401040002', 'Dewi Lestari', 'dewi@example.com', 19, 2),
    ('2401040099', 'Data Sementara', 'sementara@example.com', 18, 2);

UPDATE mahasiswa
SET email = 'alfa.julyana27@example.com'
WHERE nim = '2401020007';

DELETE FROM mahasiswa
WHERE nim = '2401040099';

SELECT m.nim, m.nama, m.email, m.usia, p.nama_prodi
FROM mahasiswa AS m
JOIN program_studi AS p
    ON p.id = m.program_studi_id
ORDER BY m.nim;