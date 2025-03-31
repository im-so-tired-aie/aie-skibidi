import requests
import json

# Configuration
API_URL = "http://wkXX.ws.org/XX_Module_C/api"  # Replace XX with your workstation number
ADMIN_URL = "http://wkXX.ws.org/XX_module_C/admin"
#  NOTE:  You'll need to replace these with valid user credentials from your 'data.sql'
TEST_USER_CREDENTIALS = {
    "email": "johndoe@nyaa.sg",
    "password": "password"
}

# Helper Functions
def register_user(client, name, email, password, nric, address, contact_no, dob, gender, race, nationality, programme_id):
    url = f"{API_URL}/register"
    payload = {
        "name": name,
        "email": email,
        "password": password,
        "nric": nric,
        "address": address,
        "contact_no": contact_no,
        "dob": dob,
        "gender": gender,
        "race": race,
        "nationality": nationality,
        "programme_id": programme_id
    }
    return client.post(url, data=payload)

def login_user(client, email, password):
    url = f"{API_URL}/login"
    payload = {
        "email": email,
        "password": password
    }
    return client.post(url, data=payload)

def get_user_details(client, token):
    url = f"{API_URL}/user"
    headers = {"Authorization": f"Bearer {token}"}
    return client.get(url, headers=headers)

def logout_user(client, token):
    url = f"{API_URL}/logout"
    headers = {"Authorization": f"Bearer {token}"}
    return client.post(url, headers=headers)  # Or get, check API spec

def get_categories(client):
    url = f"{API_URL}/categories"
    return client.get(url)

def get_programmes(client):
    url = f"{API_URL}/programmes"
    return client.get(url)

def get_criteria(client):
    url = f"{API_URL}/criteria"
    return client.get(url)

def create_diary_entry(client, token, title, description, organization, reflection, start_date, end_date, hours, remarks, category_id):
    url = f"{API_URL}/diaries"
    headers = {"Authorization": f"Bearer {token}"}
    payload = {
        "title": title,
        "description": description,
        "organization": organization,
        "reflection": reflection,
        "start_date": start_date,
        "end_date": end_date,
        "hours": hours,
        "remarks": remarks,
        "category_id": category_id
    }
    return client.post(url, headers=headers, data=payload)

def get_diary_entries_by_enrolment(client, token):
    url = f"{API_URL}/diaries_by_enrolment"
    headers = {"Authorization": f"Bearer {token}"}
    return client.get(url, headers=headers)

def approve_diary_entry(client, token, diary_entry_id):
    url = f"{API_URL}/diary/approve/{diary_entry_id}"
    headers = {"Authorization": f"Bearer {token}"}
    return client.put(url, headers=headers)

def reject_diary_entry(client, token, diary_entry_id):
    url = f"{API_URL}/diary/reject/{diary_entry_id}"
    headers = {"Authorization": f"Bearer {token}"}
    return client.put(url, headers=headers)

def get_student_progress(client, token):
    url = f"{API_URL}/diaries_progress_by_enrolment"
    headers = {"Authorization": f"Bearer {token}"}
    return client.get(url, headers=headers)

# ---  Admin Site (Basic -  Can expand) ---
def get_admin_criteria_list(client):
  url = f"{ADMIN_URL}/criteria"
  return client.get(url)

def get_admin_create_criterion(client):
  url = f"{ADMIN_URL}/criteria/create"
  return client.get(url)

def get_admin_edit_criterion(client, criterion_id):
  url = f"{ADMIN_URL}/criteria/{criterion_id}/edit"
  return client.get(url)

def get_admin_users_list(client):
  url = f"{ADMIN_URL}/users"
  return client.get(url)

def get_admin_create_user(client):
  url = f"{ADMIN_URL}/users/create"
  return client.get(url)

def get_admin_edit_user(client, user_id):
  url = f"{ADMIN_URL}/users/{user_id}/edit"
  return client.get(url)


# ---  Tests ---
def run_tests():
    client = requests.Session()

    # 1. User Account Management
    print("--- User Account Management ---")

    # 1a. Registration (Example)
    registration_data = {
        "name": "Test User",
        "email": "testuser@example.com",
        "password": "testpassword",
        "nric": "T1234567A",
        "address": "Test Address",
        "contact_no": "12345678",
        "dob": "2001-01-01",
        "gender": "Male",
        "race": "Other",
        "nationality": "Other",
        "programme_id": 1  #  Example: Gold programme
    }
    response = register_user(client, **registration_data)
    print(f"Register: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Registration failed"

    # 1b. Login
    response = login_user(client, TEST_USER_CREDENTIALS["email"], TEST_USER_CREDENTIALS["password"])
    print(f"Login: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Login failed"
    token = response.json().get("token")
    assert token, "Login response missing token"

    # 1c. Get Current User
    response = get_user_details(client, token)
    print(f"Get User: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get user failed"
    user_data = response.json()
    assert user_data.get("email") == TEST_USER_CREDENTIALS["email"], "Incorrect user details"

    # 1d. Logout
    response = logout_user(client, token)
    print(f"Logout: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Logout failed"

    #  Re-login to get a fresh token for subsequent tests
    response = login_user(client, TEST_USER_CREDENTIALS["email"], TEST_USER_CREDENTIALS["password"])
    token = response.json().get("token")

    # 2. Lookup Tables Listing
    print("\n--- Lookup Tables ---")

    response = get_categories(client)
    print(f"Categories: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get categories failed"

    response = get_programmes(client)
    print(f"Programmes: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get programmes failed"

    response = get_criteria(client)
    print(f"Criteria: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get criteria failed"

    # 3. Functional API
    print("\n--- Functional API ---")

    # 3a. Submit Diary Entry
    diary_data = {
        "title": "Test Diary Entry",
        "description": "Test description",
        "organization": "Test Org",
        "reflection": "Test reflection",
        "start_date": "2024-08-01",
        "end_date": "2024-08-02",
        "hours": 3,
        "remarks": "Test remarks",
        "category_id": 1  # Example
    }
    response = create_diary_entry(client, token, **diary_data)
    print(f"Create Diary: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Create diary entry failed"
    diary_entry_id = response.json().get("id")  #  Get the created entry ID

    # 3b. Get Student Diary Entries
    response = get_diary_entries_by_enrolment(client, token)
    print(f"Get Diaries: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get diary entries failed"
    assert any(entry.get("title") == "Test Diary Entry" for entry in response.json()), "Test diary entry not found"

    # 3c. Approve Diary Entry (Example -  Requires Admin Role.  May need setup)
    #  NOTE:  This will likely fail unless you have an admin user and token.
    #  The PDF doesn't give admin user details in 'data.sql', so you'd need to create one.
    #  I'm including the code structure, but you might need to adapt it.
    #admin_token = "ADMIN_TOKEN"  #  Replace with a valid admin token
    #if admin_token:
    #    response = approve_diary_entry(client, admin_token, diary_entry_id)
    #    print(f"Approve Diary: {response.status_code} - {response.json()}")
    #    assert response.status_code == 200, "Approve diary entry failed"

    # 3d. Reject Diary Entry (Example - Requires Admin Role)
    #if admin_token:
    #    response = reject_diary_entry(client, admin_token, diary_entry_id)
    #    print(f"Reject Diary: {response.status_code} - {response.json()}")
    #    assert response.status_code == 200, "Reject diary entry failed"

    # 3e. Get Student Progress
    response = get_student_progress(client, token)
    print(f"Get Progress: {response.status_code} - {response.json()}")
    assert response.status_code == 200, "Get student progress failed"

    print("\n--- Admin Site (Basic Checks) ---")
    #  These are basic checks.  You'd need to implement the admin functionality
    #  to properly test the create/edit routes.
    response = get_admin_criteria_list(client)
    print(f"Admin - Criteria List: {response.status_code}")
    assert response.status_code == 200

    response = get_admin_create_criterion(client)
    print(f"Admin - Create Criterion: {response.status_code}")
    assert response.status_code == 200

    response = get_admin_users_list(client)
    print(f"Admin - User List: {response.status_code}")
    assert response.status_code == 200

    response = get_admin_create_user(client)
    print(f"Admin - Create User: {response.status_code}")
    assert response.status_code == 200


if __name__ == "__main__":
    run_tests()
    print("\n---  All tests completed (basic checks) ---")