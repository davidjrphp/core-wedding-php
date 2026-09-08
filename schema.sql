-- PostgreSQL schema
CREATE TABLE IF NOT EXISTS guests (
  id SERIAL PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(50),
  attending VARCHAR(10) NOT NULL CHECK (attending IN ('yes','no','maybe')) DEFAULT 'maybe',
  family_side VARCHAR(10) CHECK (family_side IN ('groom','bride')),
  rsvp_status VARCHAR(12) NOT NULL CHECK (rsvp_status IN ('pending','acknowledged','declined')) DEFAULT 'pending',
  message VARCHAR(500),
  created_at TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_guests_created_at ON guests(created_at);
CREATE INDEX IF NOT EXISTS idx_guests_attending ON guests(attending);
CREATE INDEX IF NOT EXISTS idx_guests_rsvp_status ON guests(rsvp_status);

CREATE TABLE IF NOT EXISTS photos (
  id SERIAL PRIMARY KEY,
  path VARCHAR(512) NOT NULL,
  caption VARCHAR(255),
  uploaded_at TIMESTAMP NOT NULL DEFAULT NOW()
);
