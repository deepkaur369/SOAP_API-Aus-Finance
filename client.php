<?php
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$street=$_POST['street'];
$city=$_POST['city'];
$pin=$_POST['pin'];

$soapURL = "soap.wsdl";
$client = new SoapClient($soapURL); 
$authHeader ="<soapenv:Header><web:SessionType>none</web:SessionType><web:PasswordText>jf03ld</web:PasswordText><web:UsernameToken>FLEXWSINTTEST</web:UsernameToken></soapenv:Header>";
$authenticationHeader = new SoapHeader("https://flexuat.afgonline.com.au/eai_enu/start.swe?SWEExtSource=WebService&amp;SWEExtCmd=Execute&amp;WSSOAP=1", "Authentication", new SoapVar($authHeader, XSD_ANYXML), true);
$client->__setSoapHeaders(array($authenticationHeader));

$data = json_decode('{
"Opportunity": {
          "ApplicationState": "WA",
          "AssignedDate": "01/11/2013",
          "AppointmentBookedDate": "03/11/2013",
          "AppointmentCompletedDate": "04/11/2013",
          "OnHoldDate": "05/11/2013",
          "CloseDate": "05/11/2013",
          "CloseReason": "Other",
          "Comments": "Testing Opty Sync V4",
          "ContactedDate": "01/11/2013",
          "CustomNumber1": "5",
          "CustomDate1": "01/01/1990",
          "CustomText1": "Test",
          "Description": "Testing Opty Sync V4 (2)",
          "DesiredSurplus": "8000",
          "ExitStrategyCode": "Downgrade",
          "ExitStrategyDescription": "Strategy desc.",
          "FHB": "Y",
          "FHBAmount": "7000",
          "HOC": "Y",
          "IntegrationId": "Opp-001",
          "LoanWriterId": "FLEXWSINTTEST",
          "LeadSource": "Sikander Lead",
          "OwnFunds": "100000",
          "CashSavings": "2000",
          "GiftAmount": "3000",
          "PreApproval": "Y",
          "ProposedLoanAmount": "940000",
          "ProposedLoanTerm": "30",
          "ReceiveDocumentation": "All Applicants",
          "LegalRepresentation": "Solicitor",
          "LenderNote": "Sample note to lender",
          "ReferrerAsOnRCTI": "Testing referrer",
          "RequirementsAndObjectives": "Testing web service",
          "StartDate": "10/10/2017",
          "Applicant": [
            {
              "Channel": "Web",
              "DirectAddressStreet": "'.$street.'",
              "DirectAddressCity": "'.$city.'",
              "DirectAddressPostalCode": "'.$pin.'",
              "DirectAddressState": "WA",
              "LeadAssignedFlag": "N",
              "Source": "Website",
              "BestCallTime": "Early morning",
              "CellularPhone": "0410-111-222",
              "Comments": "from web site",
              "DateOfBirth": "'.$dob.'",
              "DriversLicense": "123000000",
              "Company": "N",
              "Dependents": "2",
              "DependentAge": [
                {
                  "Name": "Allan",
                  "Age": "5"
                },
                {
                  "Name": "Steve",
                  "Age": "10"
                }
              ],
              "Director": "Y",
              "DoNotCall": "Y",
              "DoNotSendEmail": "Y",
              "DoNotSendMail": "Y",
              "DoNotSendMarketing": "Y",
              "DoNotSendSMART": "N",
              "EmailAddress": "'.$email.'",
              "FirstName": "'.$fname.'",
              "Gender": "M",
              "Guarantor": "N",
              "HomePhone": "+610811112222",
              "HouseholdContact": "Y",
              "IntegrationId": "app-001",
              "LastName": "'.$lname.'",
              "MiddleName": "Allen",
              "PreferredCommunications": "Mobile Phone",
              "PreferredName": "John",
              "SelfEmployed": "N",
              "TakingResidence": "Y",
              "TaxDeductableAmt": "6000",
              "TaxDeductableAmtExisting": "4000",
              "Title": "Mr",
              "WorkPhone": "+610899991111",
              "HomeFax": "+610877770000",
              "AusPermResidentFlag": "Y",
              "PreviousName": "Johnny",
               "Identification": {
                  "IntegrationId": "NT-101",
                  "DocumentNumber": "DL12345",
                  "DocumentType": "DriversLicenceAust",
                  "NameOnDocument": "John Citizen",
                  "IssueDate": "01/01/1996",
                  "ExpiryDate": "01/01/2016",
                  "IssuedBy": "Government",
                  "StateIssued": "ACT",
                  "OriginalOrCertified": "Certified",
                  "VerifiedByFullName": "Y",
                  "VerifiedByDOB": "Y",
                  "VerifiedByPhoto": "Y",
                  "VerifiedByAddress": "Y",
                  "VerifiedBySignature": "Y"
                },
              "WorkFax": "+610899992222",
              "ForeseeableChange": "No",
              "CompanyName": "Testing Org",
              "ServiceabilityGuarantor": "N"
             }
          ],
          "Activity": [
            {
              "Alarm": "N",
              "Comment": "Testing",
              "Description": "Calling John",
              "Duration": "15",
              "IntegrationId": "act-001",
              "Planned": "01/12/2016 08:00:00",
              "Priority": "1-ASAP",
              "Status": "Not Started",
              "Type": "Call"
            }
          ]
      }
   }');

$data->CallingSystem = 'AFGIntegrationTesting';
$data->SendConfirmationEmail = 'N';
$data->UpdateToken = '';
$data->SimpologyBypass = '?';
$data->KeepLocking = '';
$data->Error_spcCode = '';
$data->EmailAddrOverwrite = '?';


$function = $client->__soapCall('SyncOpportunity4',array($data));
print_r($function->Opportunity->Applicant->FLEXId);