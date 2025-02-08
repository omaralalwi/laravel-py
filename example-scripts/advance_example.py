#!/usr/bin/env python3
import sys
import json
import os

def main():
    # Retrieve command-line arguments (excluding the script name)
    args = sys.argv[1:]

    # Retrieve environment variables
    env_vars = os.environ

    # Prepare the response dictionary
    response = {
        'script': 'sum_calculator.py',
        'received_args': args,
        'received_env_vars': {}
    }

    # Process environment variables
    allowed_env_vars = ['FIRST_ENV_VAR', 'SECOND_ENV_VAR', 'ANOTHER_VAR']
    for var in allowed_env_vars:
        if var in env_vars:
            response['received_env_vars'][var] = env_vars[var]

    # Validate input arguments
    if not args:
        response['error'] = 'No numbers provided to calculate the sum.'
        print(json.dumps(response))
        sys.exit(1)

    # Convert arguments to floats (to handle decimal numbers)
    try:
        numbers = [float(arg) for arg in args]
    except ValueError:
        response['error'] = 'All arguments must be numbers.'
        print(json.dumps(response))
        sys.exit(1)

    # Calculate the sum
    total = sum(numbers)

    # Add the result to the response
    response['sum'] = total

    # Return the response as JSON
    print(json.dumps(response))

if __name__ == "__main__":
    main()
