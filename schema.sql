-- PostgreSQL schema
CREATE TABLE IF NOT EXISTS guests (
  id SERIAL PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(50),
  attending VARCHAR(10) NOT NULL CHECK (attending IN ('yes','no','maybe')) DEFAULT 'maybe',
  message VARCHAR(500),
  created_at TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_guests_created_at ON guests(created_at);
CREATE INDEX IF NOT EXISTS idx_guests_attending ON guests(attending);

CREATE TABLE IF NOT EXISTS photos (
  id SERIAL PRIMARY KEY,
  path VARCHAR(512) NOT NULL,
  caption VARCHAR(255),
  uploaded_at TIMESTAMP NOT NULL DEFAULT NOW()
);
